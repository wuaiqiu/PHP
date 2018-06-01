<?php


/*
 * PHPInfo:
 *     extension_loaded(string):检查一个扩展是否已经加载，大小写敏感。
 *     get_loaded_extensions():返回了所有PHP加载的模块名。
 *     get_extension_funcs($module):返回模块内定义的所有函数的名称。参数必须是小写的。
 *
 *     gc_collect_cycles():强制收集所有现存的垃圾循环周期。
 *     gc_disable():停用循环引用收集器。
 *     gc_enable():激活循环引用收集器。
 *     gc_enabled():返回循环引用计数器的状态。
 *     gc_mem_caches():返回被回收的内存大小(byte)。
 *
 *     get_current_user():返回当前PHP脚本所有者名称。
 *     getmyuid():获取当前脚本的用户ID。
 *     getmygid():获取当前PHP脚本拥有者的用户组ID。
 *     getlastmod():获取执行的主脚本的最后修改时间。
 *     getmyinode():获取当前脚本的索引节点（inode）。
 *     getmypid():获取当前PHP进程ID。
 *     getrusage():获取当前资源使用状况。
 *     memory_get_peak_usage():返回分配给你的PHP脚本的内存峰值字节数。
 *     memory_get_usage():返回当前分配给你的PHP脚本的内存量，单位是字节（byte）。
 *     php_sapi_name():返回描述PHP所使用的接口类型。
 *     php_uname():返回运行PHP的系统的有关信息。
 *     phpversion():获取当前的PHP版本。
 *     set_time_limit(int):设置脚本最大执行时间(s)。
 *     zend_version():获取当前运行的 Zend 引擎的版本字符串。
 *     phpinfo():输出关于PHP配置的信息。
 *
 *     get_defined_constants():返回当前所有已定义的常量名和值。
 *     get_resources():获取当前已打开的资源。
 *     putenv(string):设置环境变量的值。
 *     getenv(string):获取一个环境变量的值。
 *
 *     get_cfg_var(string):获取PHP配置选项option的值。
 *     get_include_path():获取当前include_path配置选项的值。
 *     set_include_path(string):设置include_path配置选项。
 *     restore_include_path():还原include_path配置选项的值。
 *     get_included_files():返回所有被include、include_once、require和require_once 的文件名。
 *     get_required_files():get_included_files()的别名。
 *     ini_get_all():获取所有已注册的配置选项。
 *     ini_get(string):返回配置选项的值。
 *     ini_set ($name,$value):设置指定配置选项的值。
 *     ini_alter():ini_set()的别名。
 *     ini_restore(string):恢复指定的配置选项到它的原始值。
 *     php_ini_loaded_file():检查是否有加载的php.ini文件，并取回它的路径。
 *     sys_get_temp_dir():返回PHP储存临时文件的默认目录的路径。
 * */