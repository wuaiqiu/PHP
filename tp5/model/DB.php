<?php
#数据库

//1.原始操作
Db::query('select * from think_user where id=?',[8]);
Db::execute('insert into think_user (id, name) values (?, ?)',[8,'thinkphp']);
Db::query('select * from think_user where id=:id',['id'=>8]);
Db::execute('insert into think_user (id, name) values (:id, :name)',['id'=>8,'name'=>'thinkphp']);


//2.查询构造器
#基本查询
Db::table('think_user')->where('id',1)->find(); //查询一个数据
Db::table('think_user')->where('status',1)->select(); //查询数据集使用
Db::table('think_user')->where('id',1)->value('name');//返回某个字段的值
Db::table('think_user')->where('status',1)->column('name');//查询某一列的值
Db::table('think_user')->field(['id'=>'ids','title','content'])->select();//查询指定列的值
Db::table('think_user')->distinct(true)->field('user_login')->select();//去重复值
$result = Db::table('think_user')->fetchSql(true)->find(1);//直接返回SQL

#添加数据
Db::table('think_user')->insert(['foo' => 'bar', 'bar' => 'foo']); //添加一条数据
Db::table('think_user')->insertGetId(['foo' => 'bar', 'bar' => 'foo']); //添加数据成功返回添加数据的自增主键
Db::table('think_user')->insertAll($data); //添加多条数据

#更新数据
Db::table('think_user')->where('id', 1)->update(['name' => 'thinkphp']);
Db::table('think_user')->where('id',1)->setField('name', 'thinkphp'); //更新某个字段
Db::table('think_user')->where('id', 1)->setInc('score');//score 字段加 1
Db::table('think_user')->where('id', 1)->setInc('score', 5);//score 字段加 5
Db::table('think_user')->where('id', 1)->setDec('score'); //score 字段减 1
Db::table('think_user')->where('id', 1)->setDec('score', 5); //score 字段减 5

#删除数据
Db::table('think_user')->delete(1);//根据主键删除
Db::table('think_user')->delete([1,2,3]);
Db::table('think_user')->where('id',1)->delete(); //条件删除
Db::table('think_user')->where('id','<',10)->delete();

#数据集分批处理
Db::table('think_user')->chunk(100, function($users) {
    foreach ($users as $user) {
        return false; //表示终止
    }
});


//3.查询方法
#AND查询
Db::table('think_user')->where('id','>=',3)->where('status',1)->find();
#OR查询
Db::table('think_user')->where('id','>=',3)->whereOr('status',1)->find();
#数组查询
$map['id']  = ['>=',3];
$map['status']=1;
Db::table('think_user')->where($map)->find();
#连接查询
Db::table('think_user')->alias(['think_user'=>'user','think_dept'=>'dept'])->join('think_dept','dept.user_id= user.id')->select();
Db::table('think_user')->alias(['think_user'=>'user','think_dept'=>'dept'])->join('think_dept','dept.user_id= user.id','RIGHT')->select();
#排序查询
Db::table('think_user')->where('status','1')->order(['order','id'=>'desc'])->select();
#分页查询(从第10行开始的10条数据)
Db::table('think_article')->limit(10,10)->select();
Db::table('think_article')->page(2,10)->select();
#分组查询(只能用字符串)
Db::table('think_user')->field('user_id,username,max(score)')->group('user_id')->select();
Db::table('think_user')->field('user_id,username,max(score)')->group('user_id')->having('user_id>3')->select();
#联合查询
Db::table('think_user')->union('SELECT * FROM think_user_1')->union('SELECT * FROM think_user_2')->select();
Db::table('think_user')->union('SELECT * FROM think_user_1',true)->union('SELECT * FROM think_user_2',true)->select();
#聚合查询
Db::table('think_user')->count('id');
Db::table('think_user')->max('score');
Db::table('think_user')->min('score');
Db::table('think_user')->avg('score');
Db::table('think_user')->sum('score');


//4.事务操作
Db::transaction(function(){
    Db::table('think_user')->find(1);
    Db::table('think_user')->delete(1);
});


//5.ORM
#1.新增一条;并返回的是当前模型的对象实例
User::create(['name'  =>  'thinkphp', 'email' =>  'thinkphp@qq.com']);
#2.更新数据
User::where('id', 1)->update(['name' => 'thinkphp']);
#3.删除数据
User::destroy(1); //根据主键删除
User::destroy([1,2,3]);
User::where('id','>',10)->delete(); //根据条件删除
#4.查询
$user = User::get(1); //取出主键为1的数据
$user = User::get(['name' => 'thinkphp']); //使用数组查询
$list = User::all([1,2,3]); //获取多个数据
$list = User::all(['status'=>1]);
User::find(1)->toArray(); //转换为数组
User::find(1)->toJson(); //JSON序列化
User::find(1)->hidden(['create_time','update_time']);//设置不输出的字段