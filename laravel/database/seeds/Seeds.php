<?php
/*
 * 数据填充
 * 
 * */

class Seeds extends Seeder{
    
    //运行数据库填充
    public function run(){
        DB::table('users')->insert(
            ['name'=>'zhagnsan','id'=>1,'class'=>'12'],
            ['name'=>'lisi','id'=>2,'class'=>'12']
          );
    }
}