<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model{
    
    #指定表名
    protected  $table="users";
    
    #指定主键
    protected  $primaryKey="id";
    
    #指定允许批量赋值的字段
    protected  $fillable=['name','class','id'];
    
    #指定禁止批量赋值的字段
    protected  $guarded=[];
    
    #不自动维护时间戳(create方法，updated_at与created_at字段)
    public  $timestamps=false;
}