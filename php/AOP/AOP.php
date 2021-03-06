<?php
/*
 * AOP(Aspect Oriented Programming,面向切面编程)
 *
 *   Aspect(切面)：包含各个模块的共同代码片的集合
 *   Advice（增强）：Advice用于调用Aspect（切面）某个代码块的处理
 *   Joinpoint（连接点）：Joinpoint是需要各个模块的方法
 *   Pointcut（切入点）：Jointpoint具体的连接点
 *
 *   Advice类型
 *     前置增强（Before advice）：在某连接点之前执行的增强，但这个增强不能阻止连接点前的执行（除非它抛出一个异常）
 *     后置返回增强（After returning advice）：在某连接点正常完成后执行的增强
 *     后置异常增强（After throwing advice）：在方法抛出异常退出时执行的增强。
 *     后置最终增强（After (finally) advice）：当某连接点退出的时候执行的增强（不论是正常返回还是异常退出）。
 *     环绕增强（Around Advice）：包围一个连接点的增强， 环绕增强可以在方法调用前后完成自定义的行为。
 * */

//Aspect切面类
class Aspect{
    static function log(){
        echo "This is log<br/>";
    }
    static function checkAuthentication(){
        echo "This is checkAuthentication<br/>";
    }
}


//增强类
class AOP{
    function __call($method,$args) {
       Aspect::checkAuthentication();
       call_user_func_array(array($this, $method), $args=[]);
       Aspect::log();
     
    } 
}


class Blog extends AOP{

    //切入点(protected，父类才可以调用)
   protected function createBlog(){
        echo "This createBlog<br/>";
    }
    
    //切入点(protected，父类才可以调用)
   protected function editBlog(){
       echo "This is editBlog<br/>";
    }
    
}


$blog=new Blog();
$blog->createBlog();
$blog->editBlog();
