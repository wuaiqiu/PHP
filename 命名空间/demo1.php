<?php
namespace  MyProject;


//define(PI,3.14);          #Use of undefined constant PI
const PI=3.12;              #正确



namespace MyProject\Sub\Level;
const PI=3;  
function fun(){
    
    echo "<br/>这是子命名空间函数fun";
    }


echo PI;


