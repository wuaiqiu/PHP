#------------------------yield-----------------------------#
=begin
 (1)块总是从与其具有相同名称的函数调用。这意味着如果您的块名称为 test，那么您要使用函数 test 
来调用这个块。您可以使用 yield 语句来调用块。
=end
 
  def test
     puts "在 test 方法内"
     yield
     puts "你又回到了 test 方法内"
     yield
  end
  

  test {puts "你在块内"}
  #>在 test 方法内
  #>你在块内
  #>你又回到了 test 方法内
  #>你在块内
 

=begin
  (2)传递带有参数的 yield 语句
  在块中，您可以在两个竖线之间放置一个变量来接受参数。因此，在上面的代码中，yield 5 语句向 test 
块传递值 5 作为参数。
  如果您想要传递多个参数，那么 yield 语句如下所示：
        yield a, b
        test {|a, b| statement}
=end
  
  def test
     yield 5
     puts "在 test 方法内"
     yield 100
  end
  
  test {|i| puts "你在块 #{i} 内"}
  #>你在块 5 内
  #>在 test 方法内
  #>你在块 100 内
    
#-----------------------proc与lambda对象------------------------------#
=begin
Proc对象：Proc是由块转换来的对象。
=end
# 法一
inc = Proc.new { | x | x + 1}
inc.call(2)  #=> 3

# 法二
inc = lambda {| x | x + 1 }
inc.call(2)  #=> 3

# 法三
inc = proc {|x| x + 1 }
inc.call(2) #=> 3


=begin
还有一种通过&操作符的方式，将代码块与Proc对象进行转换。
&符号的含义是： 这是一个Proc对象，我想把它当成代码块来使用。去掉&符号，将能再次得到一个Proc对象。
=end

def my_method(&the_proc)
      the_proc
end

p = my_method {|name| "Hello, #{name} !"}
p.call("Bill")   #=> "Hello,Bill"


=begin
如果需要将某个代码块作为参数传递给方法，需要通过为这个参数添加&符号，并且其位置必须是在参数的最后
一个
=end
def my_method(greeting)
    "#{greeting}, #{yield}!"
end

my_proc = proc { "Bill" }
my_method("Hello", &my_proc)


=begin
proc与lambda的区别
  a.return的作用域不同
        def fun
              p = proc { return 10 }
              result = p.call   
              return result * 2 
        end
        >result=10

        def fun
              p = lambda { return 10 }
              result = p.call   
              return result * 2 
        end
        >result=20

  b.参数检查方式
        p=proc{|a,b| puts a;puts b}
        p.call(1,2) #1 2
        p.call(1)   #1 nil
        p.call(1,2,3)#1 2
        
        p=lambda{|a,b|puts a;puts b}
        p.call(1,2) #1 2
        p.call(1)   #error
        p.call(1,2,3)#error
=end