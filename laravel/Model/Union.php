<?php
/*
 * 关联模型
 * */

#一对一(uid为phone的外键，id为student的主键)
public function phone(){
    return $this->hasOne('App\Phone', 'uid', 'id');
}
#获取phone
$phone = Student::find(1)->phone;

#逆向一对一(uid为phone的外键，id为student的主键)
public function student(){
    return $this->belongsTo('App\Student','uid','id');
}
#获取student
$phone = Student::find(1)->student;


#一对多(uid为phone的外键，id为student的主键)
public function phone(){
    return $this->hasMany('App\Phone', 'uid', 'id');
}
#获取phone
$phone = Student::find(1)->phone;

#逆向一对多(uid为phone的外键，id为student的主键)
public function student(){
    return $this->belongsTo('App\Student','uid','id');
}
#获取student
$phone = Student::find(1)->student;


#多对多(1.关联的Role的模型；2.中间表名；3.本表的主键（中间表的外键）；4.关联表的主键（中间表的外键）)
return $this->belongsToMany('App\Role', 'user_roles', 'user_id', 'role_id');