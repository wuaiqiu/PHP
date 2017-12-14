<?php
/*
 * (1).原始操作
 * 
 * #查询
 * $students=DB::select("select * from users");
 * $students=DB::select("select * from users where id > ?",[22]);
 * $students=DB::select("select * from users where id = :id", ["id" => 1]);
 * 
 * 
 * #增加
 * $bool=DB::insert("insert into users values(23,'eason',12)");
 * $bool=DB::insert("insert into users values(?,?,?)",[24,'jay',22]);
 * 
 * 
 * #更新
 * $num=DB::update('update users set name=? where id=?',['eason',103]);
 * 
 * 
 * #删除
 * $num=DB::delete('delete from users where id = ?',[103]);
 * 
 * 
 * #事务处理
 * DB::transaction(function () {
 *      DB::table('users')->update(['votes' => 1]);
 *      DB::table('posts')->delete();
 * });
 * 
 * 
 * #手动使用事务
 * DB::beginTransaction();
 * DB::rollBack();
 * DB::commit();
 * 
 * 
 * 
 * (2).查询构造器
 * 
 * #查询
 * $students=DB::table("users")->get():获取所用行
 * $students = DB::table('users')->distinct()->get():返回不重复的结果集
 * $email = DB::table('users')->where('name', 'John')->value('email'):从结果中获取单个值
 * $students=DB::table("users")->where('id','>=',5)->get():获取指定条件所用行
 * $students = DB::table('users')->where('votes', '>', 100)->orWhere('name', 'John')->get()：or型条件
 * $student=DB::table("users")->orderBy('id','desc')->first():获取一行
 * $student = DB::table('users')->groupBy('account_id')->having('account_id', '>', 100)->get():分组
 * $names=DB::table("users")->pluck('name'):获取name列
 * $fields=DB::table("users")->select("id","name")->get():获取id,name字段所用行
 * DB::table('users')->orderBy('id')->chunk(100, function($users) {
 *                  foreach ($users as $user) {
 *                      //每次读取100条数据，并把所有数据读完
 *                  }
 * });
 * 
 * 
 * #增加
 * $bool=DB::table("users")->insert(['id'=>25,'name'=>'leehom','class'=>2]);
 * $bool=DB::table("users")->insert([
 *          ['id'=>28,'name'=>'leehom','class'=>2],
 *          ['id'=>29,'name'=>'eason','class'=>3]
 * ]);
 * 
 * 
 * #更新
 * $num=DB::table("users")->increment('class')：自减1
 * $num=DB::table("users")->increment('class',3):自减2
 * $num=DB::table("users")->decrement('class',3):自减2
 * $num=DB::table('users')->where('id', 1)->update(['votes' => 1]);
 * 
 * #删除
 * $num=DB::table("users")->where('id',29)->delete();
 * $num=DB::table("users")->where('id','>=',29)->delete();
 * $num=DB::table("users")->delete();
 * $num=DB::table("users")->truncate();
 * 
 * 
 * #聚合函数
 * $count=DB::table("users")->count();
 * $max=DB::table("users")->max("id");
 * $min=DB::table("users")->min("id");
 * $avg=DB::table("users")->avg("id");
 * $sum=DB::table("users")->sum("id");
 * 
 * 
 * #连接
 * $students = DB::table('users')->join('contacts', 'users.id', '=', 'contacts.user_id')-get():内连接
 * $students = DB::table('users')->leftJoin('posts', 'users.id', '=', 'posts.user_id')->get():左连接
 *
 *
 * #联合
 * $students = DB::table('users')->union(DB::table('students'))->get():
 * $students = DB::table('users')->unionAll(DB::table('students'))->get():去重复
 * 
 * 
 * #分页
 * $students = DB::table('users')->skip(10)->take(5)->get();
 * $students = DB::table('users')->offset(10)->limit(5)->get();
 * 
 *
 *
 * (3).Eloquent ORM(可以使用构造器)
 *
 * #查询
 * $students=Student::all():获取所有结果
 * $student=Student::find(1)：返回主键为1的数据
 * $student=Student::findOrFail(1)：没找到就抛错
 * $student=Student::find([1,2,3])：返回主键为1,2,3的数据数组
 * foreach (Students::where('id','>', 20)->cursor() as $user) {
 *         echo $user->name."<br/>";//使用游标，在处理大批量数据时，可大幅减少内存消耗：
 *  }
 *
 *
 * #新增（create方法需要指定fillable或guarded属性）
 * $student=Student::create(['name'=>'eason','class'=>12,"id"=>28])：通过属性获取实例，插入数据库
 * $student=Student::firstOrCreate(['name'=>'eason','class'=>12,"id"=>28])：通过属性获取实例, 如果不存在则插入数据库.
 * $students=Student::firstOrNew(['name'=>'eason','class'=>13,"id"=>29])：通过属性获取实例, 如果不存在初始化一个新的实例，没有插入
 * $bool=$students->save()：插入一个数据
 *
 *
 * #更新
 * $students=Student::find(29);
 * $students->class=111;
 * $bool=$students->save()：更新一个数据
 * $num=Student::where("id",">=","28")->update(['class'=>111]);
 *
 *
 * #删除
 * $students=Student::find(29);
 * $bool=$students->delete();
 * $num=Student::destroy([28,29])：删除主键为28,29的数据
 * 
 * 
 * (4).记录序列化
 *  $students->toArray()：序列化为数组
 *  $students->toJson()：序列化为 JSON
 *  $user->makeVisible('attribute')->toArray()：临时暴露属性
 *  $user->makeHidden('attribute')->toArray();临时隐藏属性
 * */