<?php

/*
 *  PHPUnit:
 *
 *    1.针对类Class的测试写在类ClassTest中。
 *    2.ClassTest（通常）继承自 PHPUnit\Framework\TestCase。
 *    3.测试都是命名为test*的公用方法。也可以在方法的文档注释块使用@test标注将其标记为测试方法。
 *    4.编写断言方法：
 *      assertTrue(true); //判断实际值是否为true
 *      assertEquals('orz', 'oxz', 'The string is not equal with orz'); //预期值是orz，实际值是oxz，若两个值不相等，则显示后面字符串
 *      assertCount(1, array('Monday'));  //预期数组大小为1
 *      assertContains('PHP', array('PHP', 'Java', 'Ruby'));  //预期数组中有一个PHP字串的元素存在
 *   5.	print或var_dump调试表达式不会有输出
 *   6.用 @depends 标注来表达测试方法之间的依赖关系，依赖函数必须在测试方法之前，因为@depends不会改变执行顺序
 *   7.如果需要传递对象的副本而非引用，则应当用 @depends clone 替代 @depends。
 *   8.用 @dataProvider 标注来指定使用哪个数据供给器方法.
 *   9.数据供给器方法必须声明为public，其返回值是一个数组，其每个元素也是数组，或者是一个实现了 Iterator 接口的对象
 *   10.来自于数据供给器的参数将先于来自所依赖的测试的参数
 * */


use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{

    //test
    public function testPushAndPop()
    {
        $stack = [];
        $this->assertEquals(0, count($stack));
        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack) - 1]);
        $this->assertEquals(1, count($stack));
    }


    //depends
    public function testEmpty()
    {
        $stack = [];
        $this->assertEmpty($stack);
        return $stack;
    }

    /**
     * @depends testEmpty
     */
    public function testPush(array $stack)
    {
        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack)-1]);
        $this->assertNotEmpty($stack);
        return $stack;
    }


    //dataprovider
    public function additionProvider()
    {
        return [
            [0, 0, 0],
            [0, 1, 1],
            [1, 0, 1],
            [1, 1, 3]
        ];
    }

    /**
     * @dataProvider additionProvider
     */
    public function testAdd($a, $b, $expected)
    {
        $this->assertEquals($expected, $a + $b);
    }


    //多个depends与单个dataprovider
    public function provider()
    {
        return [['provider2']];
    }

    public function testProducerFirst()
    {
        $this->assertTrue(true);
        return 'first';
    }

    public function testProducerSecond()
    {
        $this->assertTrue(true);
        return 'second';
    }

    /**
     * @depends testProducerFirst
     * @depends testProducerSecond
     * @dataProvider provider
     */
    public function testConsumer()
    {
        $this->assertEquals(
            ['provider2','first','second'],
            func_get_args()
        );
    }
}


/*
 * 错误处理:
 *
 *     1.判断是否抛出异常方法:
 *         expectException(InvalidArgumentException::class) ==> @expectedException InvalidArgumentException
 *         expectExceptionCode(22) ==> @expectedExceptionCode 22
 *         expectExceptionMessage("This is Error") ==> @expectedExceptionMessage "This is Error"
 * */

class ExceptionTest extends TestCase
{

    public function testErro(){
        $this->expectException(InvalidArgumentException::class);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testException()
    {
    }
}

/*
 * 对输出进行测试:
 *     1.判断输出方法：
 *         void expectOutputRegex(string $regularExpression):设置输出预期为输出应当匹配正则表达式$regularExpression。
 *         void expectOutputString(string $expectedString):设置输出预期为输出应当与 $expectedString 字符串相等。
 * */

class OutputTest extends TestCase
{
    public function testExpectFooActualFoo()
    {
        $this->expectOutputString('foo');
        print 'foo';
    }
}