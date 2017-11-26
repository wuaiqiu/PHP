# Smarty


**一.Smarty初始化**

```
require_once './libs/Smarty.class.php';

$smarty=new Smarty();
#设置模板目录
$smarty->setTemplateDir("./tpl/");
#设置合成目录
$smarty->setCompileDir("./compose/");
#设置变量配置目录[配置文件传值]
$smarty->setConfigDir("./config/");
```

<br/>

**二.传值**

**(1).直接传值**

```
#普通变量   {$key1}
$smarty->assign("key1","value1");

#数组     {$key2['a']}
$smarty->assign('key2',array('a'=>'A','b'=>'B'));

class Person{
    public $name="zhangsan";
    public $age=12;
}
#对象     {$key3->name};
$smarty->assign('key3',new Person());

#视图渲染
$smarty->display('index.html');
```

**(2).读取配置文件**

config/config.conf

```
#全局变量
key1=zhangsan
#index局部变量
[index]
key2=lisi
```

tpl/index.html

```
#调用全局配置变量
{config_load file="config.conf"}
#调用局部配置变量
{config_load file="config.conf" section="index"}

#访问
{#key1#}
{$smarty.config.key1}
```

**(3).预定义常量，内置$smarty变量**

```
#页面请求变量 如$_GET, $_POST, $_COOKIE, $_SERVER, $_ENV 和 $_SESSION
	{$smarty.get.id}
	{$smarty.post.id}
	{$smarty.cookies.username}
	{$smarty.server.SERVER_NAME}
	{$smarty.env.PATH}
	{$smarty.session.id}
 
#直接访问PHP的常量
	{$smarty.const.M_PI} 

#获取时间戳 
	{$smarty.now}
```

<br/>

**三.模板继承**

```
#声明继承的父模板
{extends file="base.html"}

#在子模板覆盖父模板的block内容；子模板继承父模板只能重写block区域，子模板其他区域则会被忽略
{block name="title"} 新内容 {/block}	 {*完全覆盖*}
{block name="title" append} 新内容 {/block}	{*在子模板中向后追加*}
{block name="title" prepend} 新内容 {/block}	{*在子模板中向前追加*}
{block name="title"} 需要覆{$smarty.block.child}盖的内容 {/block}	{*在父模板中指定覆盖区域*}
{block name="title"} 新{$smarty.block.parent}内容 {/block}	{*在子模板中指定父模板内容的位置*}
```

<br/>

**四.smarty内置函数**

**(1).foreach循环**

```
{foreach from=$arr key=key item=value}
          {$key}-->{$value}
{/foreach}
```

**(2).if条件**

>eq、ne、neq、gt、lt、lte、le、gte、ge、is even、is odd、is not even、is not odd、not、mod、div by、even by、odd by、==、!=、>、<、<=、>=

```
{if $name eq "Fred"}
     Welcome Sir.
{elseif $name eq "Wilma"}
    Welcome Ma'am.
{else}
    Welcome, whatever you are.
{/if}
```

**(3).section循环**

```
{section name=n loop=$people}
 name:{$people[n]}<br/>
{/section}
```

```
{section name=sn loop=$news}
    {if $smarty.section.sn.first}
             <table>
                 <th>title</th>
    {/if}
                 <tr>
                     <td>{$news[sn]}</td>
                 </tr>
    {if $smarty.section.sn.last}
             </table>
    {/if}
    {sectionelse}
        there is no news.
{/section}
```

**(4).literal忽略解析的区域（如JavaScript脚本）**

```
{literal}
    {$smarty.const.M_PI}
{/literal}
```

**(5)include包含文件**

```
{include file="base.html" arg1="value1" arg2="value2"}
```

<br/>

**五.使用插件**

```
#注册函数
registerPlugin("类型", "模板使用的函数名", "php中函数名")
```

**(1).变量调节器**：在模板中对变量输出前的处理

```
#注册变量调节器
$smarty->registerPlugin("modifier", "fun1", "fun1");
function fun1($var,$arg2=""){
    return strtoupper($var);
}

#使用
{$var|fun1}	//一个函数与一个参数
{$var|fun1:arg2:arg3..}        //一个函数与多个参数
{$var|fun1:arg2:arg3..|fun2..}    //多个函数与多个参数
```

**(2).函数**

```
#注册函数
$smarty->registerPlugin("function", "fun2", "fun2");
function fun2($args,$smarty){
	return "<p>arg1:$agrs[1]</p><p>arg2:$agrs[2]</p>";
}

#使用
{fun2 arg1="value1" arg2="value2"}
```

**(3).块函数**

```
#注册
$smarty->registerPlugin("block", "fun3", "fun3");
function fun3($args,$content,$smarty){
	return "<p>arg1:$agrs[1]</p><p>arg2:$agrs[2]</p><p>content:$content</p>";
}

#使用
{fun3 arg1="value1" arg2="value2"}块内容 {/fun3}
```

<br/>

**六.编写插件**

```
1.变量调节器(modifier.fun1.php)
function smarty_modifier_fun1($var,$arg2=""){
      return strtoupper($var);
}


2.函数(function.fun2.php)
function smarty_function_fun2($args,$smarty){
    return "<p>arg1:$agrs[1]</p><p>arg2:$agrs[2]</p>";
}

3.块函数(block.fun3.php);repeat参数表示当读到</>时为false，这样可以让块内容只读一次
function smarty_block_fun3($args,$content,$smarty,&$repeat){
    if(!repeat)
        return "<p>arg1:$agrs[1]</p><p>arg2:$agrs[2]</p><p>content:$content</p>";
}
```

<br/>

**七.静态缓存**

```
(1).开启缓存
      $smarty->caching=true;
      $smarty->setCacheDir('./cache/');

(2)设置缓存存活时间，单位s
      $smarty->cache_lifetime=30;

(3).为模板设置缓存
    if(!$smarty->isCached('key.html',$_SERVER['REQUEST_URI'])){
        $smarty->assign("time",date('H:i:s'));  #需要缓存
    }
    $smarty->assign('timestamp',time());#不需要缓存，使用需要{nocache}{/nocache}
   
(4)清除缓存
     $smarty->clearCache("模板文件名","cache_id"）:清除单个缓存文件
     $smarty->clearAllCache():清除全部缓存
```