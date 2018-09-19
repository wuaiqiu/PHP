<?php

class Instance
{
    //仅有的属性，用于保存类名、接口名或者别名
    public $id;

    //构造函数，仅将传入的ID赋值给 $id 属性
    protected function __construct($id)
    {
        $this->id=$id;
    }
    //静态方法创建一个Instance实例
    public static function of($id)
    {
        return new static($id);
    }
}

class Container
{
    //用于保存单例Singleton对象,以类名或接口名为键
    private $_singletons = [];
    //用于保存依赖的定义,以类名或接口名为键
    private $_definitions = [];
    //用于保存构造函数的参数,以类名或接口名为键
    private $_params = [];
    //用于缓存ReflectionClass对象,以类名或接口名为键
    private $_reflections = [];
    //用于缓存依赖信息,以类名或接口名为键
    private $_dependencies = [];

    //规范化
    protected function normalizeDefinition($class, $definition)
    {
        //$definition是空,转换成['class' => $class]形式
        if (empty($definition)) {
            return ['class' => $class];
        //$definition是字符串,转换成['class' => $definition]形式
        } elseif (is_string($definition)) {
            return ['class' => $definition];
        //$definition是PHP callable或对象，则直接将其作为依赖的定义
        } elseif (is_callable($definition, true) || is_object($definition)) {
            return $definition;
        //$definition是数组则确保该数组定义了class元素
        } else {
            trigger_error("Unsupported definition type for \"$class\": "
                . gettype($definition),E_USER_ERROR);
        }
    }
    //普通注册
    public function set($class, $definition="", array $params = [])
    {
        //规范化$definition并写入$_definitions[$class]
        $this->_definitions[$class] = $this->normalizeDefinition($class,
            $definition);
        //将构造函数参数写入$_params[$class]
        $this->_params[$class] = $params;
        //删除$_singletons[$class]
        unset($this->_singletons[$class]);
        return $this;
    }
    //单例注册
    public function setSingleton($class, $definition="", array $params = [])
    {
        //规范化$definition并写入$_definitions[$class]
        $this->_definitions[$class] = $this->normalizeDefinition($class,
            $definition);
        //将构造函数参数写入 $_params[$class]
        $this->_params[$class] = $params;
        //将$_singleton[$class]置为null，表示还未实例化
        $this->_singletons[$class] = null;
        return $this;
    }
    //写入依赖
    protected function getDependencies($class)
    {
        //如果已经缓存了其依赖信息,直接返回缓存中的依赖信息
        if (isset($this->_reflections[$class])) {
            return [$this->_reflections[$class], $this->_dependencies[$class]];
        }
        $dependencies = [];
        //使用PHP5的反射机制来获取类的有关信息,主要就是为了获取依赖信息
        $reflection = new ReflectionClass($class);
        //通过类的构建函数的参数来了解这个类依赖于哪些单元
        $constructor = $reflection->getConstructor();
        if ($constructor !== null) {
            foreach ($constructor->getParameters() as $param) {
                if ($param->isDefaultValueAvailable()) {
                    //构造函数如果有默认值,将默认值作为依赖.
                    $dependencies[] = $param->getDefaultValue();
                } else {
                    //构造函数没有默认值,则为其创建一个引用(Instance)
                    $c = $param->getClass();
                    $dependencies[] = Instance::of($c === null ? null :
                        $c->getName());
                }
            }
        }
        //将ReflectionClass对象缓存起来
        $this->_reflections[$class] = $reflection;
        //将依赖信息缓存起来
        $this->_dependencies[$class] = $dependencies;
        return [$reflection, $dependencies];
    }
    //解析依赖
    protected function resolveDependencies($dependencies, $reflection = null)
    {
        foreach ($dependencies as $index => $dependency) {
            //前面getDependencies()函数往$_dependencies[]中,写入的是一个Instance数组
            if ($dependency instanceof Instance) {
                if ($dependency->id !== null) {
                    //向容器索要所依赖的实例
                    $dependencies[$index] = $this->get($dependency->id);
                } elseif ($reflection !== null) {
                    $name = $reflection->getConstructor()
                        ->getParameters()[$index]->getName();
                    $class = $reflection->getName();
                    trigger_error("Missing required parameter \"$name\" when 
                        instantiating \"$class\".",E_USER_ERROR);
                }
            }
        }
        return $dependencies;
    }
    //实例创建
    protected function build($class, $params, $config)
    {
        //调用getDependencies来获取并缓存依赖信息
        list ($reflection, $dependencies) = $this->getDependencies($class);
        //用传入的$params的内容补充、覆盖到依赖信息
        foreach ($params as $index => $param) {
            $dependencies[$index] = $param;
        }
        $dependencies = $this->resolveDependencies($dependencies, $reflection);
        $object = $reflection->newInstanceArgs($dependencies);
        foreach ($config as $name => $value) {
            $object->$name = $value;
        }
        return $object;
    }
    //合并参数
    protected function mergeParams($class, $params)
    {
        if (empty($this->_params[$class])) {
            return $params;
        } elseif (empty($params)) {
            return $this->_params[$class];
        }
        $ps = $this->_params[$class];
        foreach ($params as $index => $value) {
            $ps[$index] = $value;
        }
        return $ps;
    }
    //获取注册
    public function get($class, $params = [], $config = [])
    {
        //如果是完成实例化的单例,直接引用这个单例
        if (isset($this->_singletons[$class])) {
            return $this->_singletons[$class];
        //如果是个未注册的依赖,说明它不依赖其他单元,或者依赖信息不用定义,则根据传入的参数创建一个实例
        } elseif (!isset($this->_definitions[$class])) {
            return $this->build($class, $params, $config);
        }
        //注意这里创建了$_definitions[$class]数组的副本
        $definition = $this->_definitions[$class];
        //依赖的定义是个PHP callable,调用之
        if (is_callable($definition, true)) {
            $params = $this->resolveDependencies($this->mergeParams($class,
                $params));
            $object = call_user_func($definition, $this, $params, $config);
            // 依赖的定义是个数组，合并相关的配置和参数，创建之
        } elseif (is_array($definition)) {
            $concrete = $definition['class'];
            unset($definition['class']);
            // 合并将依赖定义中配置数组和参数数组与传入的配置数组和参数数组合并
            $config = array_merge($definition, $config);
            $params = $this->mergeParams($class, $params);
            if ($concrete === $class) {
                // 这是递归终止的重要条件
                $object = $this->build($class, $params, $config);
            } else {
                // 这里实现了递归解析
                $object = $this->get($concrete, $params, $config);
            }
            //依赖的定义是个对象则应当保存为单例
        } elseif (is_object($definition)) {
            return $this->_singletons[$class] = $definition;
        } else {
            trigger_error("Unexpected object definition type: " . gettype($definition),E_USER_ERROR);
        }
        //依赖的定义已经定义为单例的，应当实例化该对象
        if (array_key_exists($class, $this->_singletons)) {
            $this->_singletons[$class] = $object;
        }
        return $object;
    }
}


class Person{}
class Human
{
    public function __construct(Person $person){}
}


$con=new Container();
$con->set('Person');
$con->set('Human');
$ret=$con->get('Human');

var_dump($ret);