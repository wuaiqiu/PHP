<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model{
    
    public static function getUser(){
        return "This is Model";
    }
}