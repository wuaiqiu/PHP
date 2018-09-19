<?php
#关联模型

//1.一对一
class User extends Model{
    public function grade(){
        /*
         * Grade:关联表
         * gid:Grade的主键
         * gids:User表的外键
         * */
        return $this->hasOne('Grade','gid','gids');
        /*
         * Grade:关联表
         * gids:User表的外键
         * gid:Grade表的主键
         * */
        return $this->belongsTo('Grade','gids','gid');
    }
}

/*
 * 查询
 * $grade=User::get(1)->grade;
 * */


//2.一对多
class User extends Model{
    public function grades(){
        /*
         * Grade:关联表
         * gid:Grade的主键
         * gids:User表的外键
         * */
        return $this->hasMany('Grade','gid','gids');
        /*
         * Grade:关联表
         * gids:User表的外键
         * gid:Grade表的主键
         * */
        return $this->belongsTo('Grade','gids','gid');
    }
}

/*
 * 查询
 * $grades=User::get(1)->grades;
 * */


//3.多对多
class User extends Model{
    public function grades(){
        /*
         * Grade:关联表
         * middle:中间表
         * uid:User表主键,中间表外键
         * gid:Grade表主键,中间表外键
         * */
        return $this->belongsToMany('Grade','middle','uid','gid');
    }
}

/*
 * 查询
 * $grades=User::get(1)->grades;
 * */