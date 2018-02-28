<?php
#数据库

//1.原始操作
Db::query('select * from user where uid=?',[1]);
Db::execute('insert into user (uid, name) values (?, ?)',[8,'thinkphp']);
Db::query('select * from user where uid=:uid',['uid'=>8]);
Db::execute('insert into user (uid, name) values (:uid, :name)',['uid'=>8,'name'=>'thinkphp']);


//2.查询构造器
#基本查询
Db::table('user')->where('uid',1)->find(); //查询一个数据
Db::table('user')->where('status',1)->select(); //查询数据集使用
Db::table('user')->where('uid',1)->value('name');//返回某个字段的值
Db::table('user')->where('status',1)->column('name');//查询某一列的值
Db::table('user')->field(['uid'=>'uids','title','content'])->select();//查询指定列的值
Db::table('user')->distinct(true)->field('user_login')->select();//去重复值
$result = Db::table('user')->fetchSql(true)->find(1);//直接返回SQL

#添加数据
Db::table('user')->insert(['foo' => 'bar', 'bar' => 'foo']); //添加一条数据
Db::table('user')->insertGetuid(['foo' => 'bar', 'bar' => 'foo']); //添加数据成功返回添加数据的自增主键
Db::table('user')->insertAll($data); //添加多条数据

#更新数据
Db::table('user')->where('uid', 1)->update(['name' => 'thinkphp']);
Db::table('user')->where('uid',1)->setField('name', 'thinkphp'); //更新某个字段
Db::table('user')->where('uid', 1)->setInc('score');//score 字段加 1
Db::table('user')->where('uid', 1)->setInc('score', 5);//score 字段加 5
Db::table('user')->where('uid', 1)->setDec('score'); //score 字段减 1
Db::table('user')->where('uid', 1)->setDec('score', 5); //score 字段减 5

#删除数据
Db::table('user')->delete(1);//根据主键删除
Db::table('user')->delete([1,2,3]);
Db::table('user')->where('uid',1)->delete(); //条件删除
Db::table('user')->where('uid','<',10)->delete();

#数据集分批处理
Db::table('user')->chunk(100, function($users) {
    foreach ($users as $user) {
        return false; //表示终止
    }
});


//3.查询方法
#AND查询
Db::table('user')->where('uid','>=',3)->where('status',1)->find();
#OR查询
Db::table('user')->where('uid','>=',3)->whereOr('status',1)->find();
#数组查询
$map['uid']  = ['>=',3];
$map['status']=1;
Db::table('user')->where($map)->find();
#连接查询
Db::table('user')->alias(['user'=>'user','dept'=>'dept'])->join('dept','dept.user_uid= user.uid')->select();
Db::table('user')->alias(['user'=>'user','dept'=>'dept'])->join('dept','dept.user_uid= user.uid','RIGHT')->select();
#排序查询
Db::table('user')->where('status','1')->order(['order','uid'=>'desc'])->select();
#分页查询(从第10行开始的10条数据)
Db::table('think_article')->limit(10,10)->select();
Db::table('think_article')->page(2,10)->select();
#分组查询(只能用字符串)
Db::table('user')->field('user_uid,username,max(score)')->group('user_uid')->select();
Db::table('user')->field('user_uid,username,max(score)')->group('user_uid')->having('user_uid>3')->select();
#联合查询
Db::table('user')->union('SELECT * FROM user_1')->union('SELECT * FROM user_2')->select();
Db::table('user')->union('SELECT * FROM user_1',true)->union('SELECT * FROM user_2',true)->select();
#聚合查询
Db::table('user')->count('uid');
Db::table('user')->max('score');
Db::table('user')->min('score');
Db::table('user')->avg('score');
Db::table('user')->sum('score');


//4.事务操作
Db::transaction(function(){
    Db::table('user')->find(1);
    Db::table('user')->delete(1);
});


//5.ORM
#1.新增一条;并返回的是当前模型的对象实例
User::create(['name'  =>  'thinkphp', 'email' =>  'thinkphp@qq.com']);
#2.更新数据
User::where('uid', 1)->update(['name' => 'thinkphp']);
#3.删除数据
User::destroy(1); //根据主键删除
User::destroy([1,2,3]);
User::where('uid','>',10)->delete(); //根据条件删除
#4.查询
$user = User::get(1); //取出主键为1的数据
$user = User::get(['name' => 'thinkphp']); //使用数组查询
$list = User::all([1,2,3]); //获取多个数据
$list = User::all(['status'=>1]);
User::find(1)->toArray(); //转换为数组
User::find(1)->toJson(); //JSON序列化
User::find(1)->huidden(['create_time','update_time']);//设置不输出的字段