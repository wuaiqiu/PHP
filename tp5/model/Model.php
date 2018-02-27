<?php
#1.模型  模型名就是数据表名

class User extends Model{
    //设置主键
    protected $pk = 'uid';
    //设置当前模型对应的完整数据表名称
    protected $table = 'think_user';
    //自定义初始化
    protected function initialize(){
        parent::initialize();
        //TODO:自定义的初始化
    }
    //在获取数据的字段值后自动进行处理
    public function getStatusAttr($value){
        $status = [-1=>'删除',0=>'禁用',1=>'正常',2=>'待审核'];
        return $status[$value];
    }
    //在数据赋值的时候自动进行转换处理
    public function setNameAttr($value){
        return strtolower($value);
    }
    //自动写入创建和更新的时间戳字段(database.php  auto_timestamp)
    protected $autoWriteTimestamp = true;
    // 定义时间戳字段名
    protected $createTime = 'create_at';
    protected $updateTime = 'update_at';
    //只读字段
    protected $readonly = ['name','email'];
    //字段设置类型自动转换
    protected $type = [
        'status'    =>  'integer',
        'score'     =>  'float',
        'birthday'  =>  'datetime',
        'info'      =>  'array'
    ];
    //查询范围  User::scope('thinkphp')->find();
    protected function scopeThinkphp($query){
        $query->where('name','thinkphp')->field('id,name');
    }
    //定义全局的查询范围  User::get(1) ==> 'status = 1 AND id = 1'
    protected function base($query){
        $query->where('status',1);
    }
}


#2.Model分层
Loader::model('User','logic'); //app\index\logic\User.php