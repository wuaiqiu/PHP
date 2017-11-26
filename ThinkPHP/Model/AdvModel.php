<?php
/*
 * 高级模型(继承Think\Model\AdvModel)
 *
 *(1).字段过滤
 *  protected $_filter = array(
 *      '过滤的字段'=>array('写入过滤规则','读取过滤规则'),
 *  )
 *
 * 过滤的规则是一个函数,传入的参数为过滤字段,可以在项目的公共函数文件里面定义这些函数
 *
 *(2).序列化字段
 *  protected $serializeField = array(
 *      'info' => array('name', 'email', 'address'),
 * );
 *
 * info（文本类型）是数据表中的实际存在的字段,name、email和address字段是不存在字段
 *
 * $User = D("User"); // 实例化User对象
 * // 然后直接给数据对象赋值
 * $User->name = 'ThinkPHP';
 * $User->email = 'ThinkPHP@gmail.com';
 * $User->address = '上海徐汇区';
 * // 把数据对象添加到数据库 name email和address会自动序列化后保存到info字段
 * $User->add();
 * 查询用户数据信息
 * $User->find(8);
 * // 查询结果会自动把info字段的值反序列化后生成name、email和address属性
 * // 输出序列化字段
 * echo $User->name;
 * echo $User->email;
 * echo $User->address;
 *
 * (3).只读字段
 *
 *  protected $readonlyField = array('name', 'email');
 *
 * (4).悲观锁和乐观锁
 *  a.悲观锁:依靠数据库的锁机制实现，以保证操作最大程度的独占性
 *      $User->lock(true)->save($data);// 使用悲观锁功能
 *  b.乐观锁:基于数据版本记录机制,开销小
 *      protected $optimLock="lock_version";
 *      在相应的数据表中添加lock_version字段
 *
 *      protected $optimLock=false  #关闭乐观锁
 *
 * (5).返回类型
 *      #实例化User对象
 *      $User = M("User");
 *      # 返回结果是一个数组数据
 *      $data = $User->find(6);
 *      #返回结果是一个stdClass对象
 *      $data = $User->returnResult($data, "object");
 *      #还可以返回自定义的类
 *      $data = $User->returnResult($data, "User");
 *
 *      Class User {
 *          public function __construct($data){
 *              // 对$data数据进行处理
 *           }
 *      } 
 * */