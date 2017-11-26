<?php
/*
 * 命名空间自动加载
 *
 *(1).加载顺序
 *      a.类库映射
 *      b.加载Library目录
 *      c.自定义的根命名空间
 *  `   d.模块目录
 *
 *(2).类库映射,给类文件定义了一个别名(在Application/Common/Conf/alias.php)
 *
 * return array(
 *          'Think\Log'        =>    THINK_PATH.'Think\Log.php',
 *          'Org\Util\Array'   =>    THINK_PATH.'Org\Util\Array.php'
 * );
 *
 * (3).自定义的根命名空间
 *
 * 'AUTOLOAD_NAMESPACE' => array(
 *      'My'     => THINK_PATH.'My',
 *      'One'    => THINK_PATH.'One',
 * );
 *
 * (4).手动加载第三方类库,没有使用命名空间
 *
 * // 导入Org类库包 Library/Org/Util/Date.class.php类库
 * import("Org.Util.Date");
 * $obj=new \Date();
 *
 * //如果你要导入的类库文件名的后缀不是class.php而是php
 * import("Driver",LIB_PATH,".php");
 *
 * //如果你的第三方类库都放在Vendor目录下面，并且都以.php为类文件后缀，也没用采用命名空间的话
 * #加载Vendor\Zend\Filter\Dir.php
 * Vendor('Zend.Filter.Dir');
 * */