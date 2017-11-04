<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Student;


class StudentController extends Controller{
      
     //原始操作
    public function  DBFacade(){
        
       #查询
       $students=DB::select("select * from users");
       dd($students);
       $students=DB::select("select * from users where id > ?",[22]);
       dd($students);
     
       
       #增加
       $bool=DB::insert("insert into users values(23,'eason',12)");
       dd($bool);
       $bool=DB::insert("insert into users values(?,?,?)",[24,'jay',22]);
       dd($bool);
     
       
       #更新
       $num=DB::update('update users set name=? where id=?',['eason',103]);
       dd($num);
       
       
       #删除
       $num=DB::delete('delete from users where id = ?',[103]);
       dd($num);
        
    } 
    
    
    //查询构造器
    public function queryCon(){

        #查询
        $students=DB::table("users")->get();
        $students=DB::table("users")->where('id','>=',5)->get();
        $students=DB::table("users")->whereRaw('id > ? and class > ?',[3,2])->get();
        dd($students);
        $student=DB::table("users")->orderBy('id','desc')->first();
        dd($student);
        $names=DB::table("users")->pluck('name');
        dd($names);
        $fields=DB::table("users")->select("id","name")->get();
        dd($fields);
        
        
        #增加
        $bool=DB::table("users")->insert(['id'=>25,'name'=>'leehom','class'=>2]);
        dd($bool);
        $bool=DB::table("users")->insert([
            ['id'=>28,'name'=>'leehom','class'=>2],
            ['id'=>29,'name'=>'eason','class'=>3]
        ]);
        dd($bool);
        
        
        #更新
        $num=DB::table("users")->increment('class');
        $num=DB::table("users")->decrement('class');
        dd($num);
        $num=DB::table("users")->increment('class',3);
        $num=DB::table("users")->decrement('class',3);
        dd($num);
        $num=DB::table("users")->where('id',12)->increment('class',3);
        $num=DB::table("users")->where('id',12)->decrement('class',3);
        dd($num);
        
        
        #删除
        $num=DB::table("users")->where('id',29)->delete();
        $num=DB::table("users")->where('id','>=',29)->delete();
        dd($num);
        $num=DB::table("users")->delete();
        $num=DB::table("users")->truncate();
        dd($num);
        
        #聚合函数
        $count=DB::table("users")->count();
        $max=DB::table("users")->max("id");
        $min=DB::table("users")->min("id");
        $avg=DB::table("users")->avg("id");
        $sum=DB::table("users")->sum("id");

    }
    
    
    //Eloquent ORM
    public function Eloquent(){
        
        #查询(可以使用构造器)
        $students=Student::all();
        $students=Student::get();
        dd($students);
        $student=Student::find(1);
        dd($student);
        
        #新增
        $student=Student::create(['name'=>'eason','class'=>12,"id"=>28]);
        dd($student);
        $student=Student::firstOrCreate(['name'=>'eason','class'=>12,"id"=>28]);
        dd($student);
        $student=Student::firstOrNew(['name'=>'eason','class'=>13,"id"=>29]);
        $bool=$student->save();
        dd($bool);
        
        #更新
        $student=Student::find(29);
        $student->class=111;
        $bool=$student->save();
        dd($bool);
        $num=Student::where("id",">=","28")->update(['class'=>111]);
        dd($num);
        
        #删除
        $student=Student::find(29);
        $bool=$student->delete();
        dd($bool);
        $num=Student::destroy([28,29]);
        dd($num);

    }
}