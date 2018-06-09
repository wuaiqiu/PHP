<?php
/*
 * PHPOpcache
 *
 * (1).配置
 *
 *  opcache.enable=1    启动操作码缓存
 *  opcache.memory_consumption=128  共享内存大小，单位为MB
 *  opcache.interned_strings_buffer=8   存储临时字符串缓存大小，单位为MB
 *  opcache.max_accelerated_files=4000  缓存文件数最大限制，命中率不到100%，可以试着提高这个值
 *  opcache.revalidate_freq=60  一定时间内检查文件的修改时间, 单位为秒
 *  opcache.fast_shutdown=1 开启快速停止续发事件
 *
 * (2).方法
 *  array opcache_get_configuration(void):获取设置的缓存配置信息，以数组形式返回配置信息、黑名单及版本号。
 *  array opcache_get_status(void):获取设置的缓存状态信息。
 *  boolean opcache_invalidate (string,$force=false):该函数的作用是使得指定脚本的字节码缓存失效。如果force为FALSE，
 * 那么只有当脚本的修改时间比对应字节码的时间更新，脚本的缓存才会失效。
 *  boolean opcache_reset(void)：该函数将重置整个字节码缓存。
 *  boolean opcache_compile_file (string):无需运行，就可以编译并缓存脚本。
 *  boolean opcache_is_script_cached (string):判断某个脚本是否已经缓存到Opcache。
 * */

class OpcacheScriptModel{

    private $_configuration;
    private $_status;

    function __construct() {
        $this->_configuration =opcache_get_configuration();
        $this->_status =opcache_get_status();
    }

    //获取配置信息
    public function getConfigDatas(){
        echo json_encode($this->_configuration);
    }

    //获取状态信息
    public function getStatusDatas(){
        echo json_encode($this->_status);
    }

    //指定某脚本文件字节码缓存失效
    public function invalidate($script){
        return opcache_invalidate($script);
    }

    //重置或清除整个字节码缓存数据
    public function reset() {
        return opcache_reset();
    }

    //无需运行，就可以编译并缓存脚本
    public function compile($file){
        return opcache_compile_file($file);
    }

    //判断某个脚本是否已经缓存到Opcache
    public function isCached($script){
        return opcache_is_script_cached($script);
    }
}



//获得对象
function getOpcacheDataModel(){
    $dataModel = NULL;
    if(NULL ==$dataModel) {
        $dataModel = new OpcacheScriptModel();
    }
    return $dataModel;
}


$cache=getOpcacheDataModel();
echo "<pre>";
$cache->compile("cache.php");
var_dump($cache->isCached("cache.php"));
var_dump($cache->isCached("index.php"));