<?php
/*
 * 表名：默认规则是模型类名的复数作为与其对应的表名，User模型类对应users数据表
 * 主键：默认每张表的主键名为id
 * 时间戳：默认情况下，Eloquent期望created_at和updated_at 已经存在于数据表中
 * 
 * */

class User extends Model{
    
    #指定表名
    protected  $table="users";
    
    #指定主键
    protected  $primaryKey="id";
    
    #指定允许批量赋值的字段(与guarded互斥)
    protected  $fillable=['name','class','id'];
    
    #指定禁止批量赋值的字段(与fillable互斥)
    protected  $guarded=[];
    
    #不自动维护时间戳
    public  $timestamps=false;
    
    #使用时间戳格式
    protected $dateFormat = 'U';
    
    
}