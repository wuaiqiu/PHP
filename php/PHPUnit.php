<?php
/*
 * 1.下载phpunit
 *       yaourt -S phpunit
 *
 * 2.设置php-cli为本地的php执行文件，设置test framework的url为/usr/share/webapps/bin/phpunit.phar
 * */

//所有以Test结尾的类均为测试用例
class SayHelloTest extends PHPUnit\Framework\TestCase{

    //每个测试用例最先运行的方法
    public function setUp(){ }

    //每个测试用例最后运行的方法
    public function tearDown(){ }

    //所有以test开头的方法均是测试方法，会自动运行
    public function testConnectionIsValid(){
        $hi = new SayHello();
        $this->assertTrue($hi->printHello() == 'Hello');
    }


}
