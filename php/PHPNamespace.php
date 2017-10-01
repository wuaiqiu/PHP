<?php
/*
 * 命名空间
 *      用于解决类（包括抽象类）、接口、函数和常量同名冲突
 *      
 *  (1)定义命名空间
 *      a.默认情况下，所有常量、类和函数名都放在全局空间下
 *         ==========================================================
 *              <?php
 *                    function fun(){}
 *                    $a=1;
 *               ?>
 *         ==========================================================
 *      b.第一个namespace必须在其它所有代码（html）之前声明命名空间,除了declare
 *         ==========================================================
 *              <?php
 *                    namespace MySpace;
 *                    function fun(){}
 *                    $a=1;
 *               ?>
 *         ========================================================== 
 *      c.可以在同一个文件中定义多个命名空间 
 *          ==========================================================
 *              <?php
 *                   (1)namespace 命名空间名1;
 *                  		....
 *                   	namespace 命名空间名2;
 *                  		...
 *                 		
 *                   (2)namespace  命名空间名1{
 *
 *                   	}
 *                  	
 *                  	namespace  命名空间名2{
 *
 *                  	}
 *               ?>
 *         ==========================================================
 *         d.在命名空间里，define的作用是全局的，而const则作用于当前空间
 *         
 *         e.同一个命名空间可以定义在多个文件中，即允许将同一个命名空间的内容分割存放在不同的文件中
 *         
 *         
 * (2)子命名空间
 *      a.命名空间的名字可以使用分层次的方式定义
 *         ==========================================================
 *              <?php
 *                    namespace MySpace\Sub\Level;
 *                    function fun(){}
 *                    $a=1;
 *               ?>
 *         =========================================================
 *         
 * (3)使用命名空间
 *          a.非限定名称,例如 $a=new foo()。如果当前命名空间是 currentnamespace，
 *      foo 将被解析为 currentnamespace\foo。如果使用 foo 的代码是全局的，不包含在
 *      任何命名空间中的代码，则 foo 会被解析为foo。
 *          b.限定名称,例如 $a = new subnamespace\foo(); 如果当前的命名空间是 
 *      currentnamespace，则 foo 会被解析为 currentnamespace\subnamespace\foo。
 *      如果使用 foo 的代码是全局的，不包含在任何命名空间中的代码，foo 会被解析
 *      为subnamespace\foo。
 *          c.完全限定名称，例如， $a = new \currentnamespace\foo(); 在这种情况下，
 *      foo 总是被解析为代码中的文字名(literal name)currentnamespace\foo 
 *      
 * (4)使用命名空间：别名/导入,为类名称使用别名、为接口使用别名或为命名空间名称使用别名
 *      use My\Full\Classname as Another;
 *      $obj = new Another; // My\Full\Classname
 *      $obj = new \Another; // 全局Another
 *      $obj = new Another\thing; //  My\Full\Classname\thing
 *      $obj = new \Another\thing; //全局 Another\thing
 * */