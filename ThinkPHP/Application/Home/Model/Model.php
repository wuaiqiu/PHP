<?php
/*
 * 模型类（主要用于数据操作）
 * 
 *   (1).模型类的作用大多数情况是操作数据表的，如果按照系统的规范来命名模型类的话，大多数情况下
 *是可以自动对应数据表。
 *      'DB_PREFIX'=>'think_'               #定义数据表前缀
 *      'DB_TYPE'   => 'mysql'              #数据库类型
 *      'DB_HOST'   => '127.0.0.1'          #服务器地址
 *      'DB_NAME'   => 'thinkphp'           #数据库名
 *      'DB_USER'   => 'root'               #用户名
 *      'DB_PWD'    => '123456'             #密码
 *      'DB_PORT'   => 3306                 #端口
 *      'DB_CHARSET'=> 'utf8'               #字符集
 *      
 *      class UserModel extends Model{} ==>对应think_user数据表
 *    
 *    
 *  (2).单独设置匹配数据表
 *       protected $tablePrefix = 'think_';      #定义模型对应数据表的前缀
 *       protected $tableName = 'user';          #不包含表前缀的数据表名称
 *       protected $trueTableName = 'think_user';#包含前缀的数据表名称，也就是数据库中的实际表名 
 *       protected $connection = array(          #设置数据库相关信息
 *                  'db_type'  => 'mysql',
 *                  'db_user'  => 'root',
 *                  'db_pwd'   => '1234',
 *                  'db_host'  => 'localhost',
 *                  'db_port'  => '3306',
 *                  'db_name'  => 'thinkphp',
 *                  'db_charset' =>    'utf8'）
 * 
 * 
 *  (3)实例化Model(可以用D与M函数)
 *      $User = new \Home\Model\UserModel();
 *    
 *  
 *  (4)字段映射(字段别名)
 *      #参数名 ==> 字段名
 *          protected  $_map=array(
 *               'birth'=>'id'
 *          );
 *      
 *      #字段名 ==> 参数名
 *          'READ_DATA_MAP'=>true
 *      
 *       
 * */