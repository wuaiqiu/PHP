<?php
/*
 * (1).单元测试，功能测试
 *
 * #在Feature目录下创建测试类(功能测试)
 * php artisan make:test UserTest
 *
 * #在Unit目录下创建测试类(单元测试)
 * php artisan make:test UserTest --unit
 *
 * #执行测试
 * phpunit
 * */

class ExampleTest extends TestCase{

    public function testBasicTest(){
        $this->assertTrue(true);
    }

    public function setUp(){
        parent::setUp();
    }
}

