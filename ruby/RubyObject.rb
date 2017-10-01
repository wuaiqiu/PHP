#------------------------------类属性与方法----------------------------#
=begin
1.属性
    a.局部变量：局部变量是在方法中定义的变量。局部变量在方法外是不可用的。
    b.实例变量：实例变量在变量名之前放置符号（@）。未初始化的实例变量的值为 nil;
          实例变量的访问器(getter) & 设置器(setter)方法
            attr_accessor :variable_name
            attr_reader :variable_name
            attr_writer :variable_name 
    c.类变量：类变量属于类，且是类的一个属性。类变量在变量名之前放置符号（@@）。必须初始化后才能在
    方法定义中使用，类变量在定义它的类或模块的子类或子模块中可共享使用。
    d.全局变量：类变量不能跨类使用。如果您想要有一个可以跨类使用的变量，您需要定义全局变量。全局变
    量总是以美元符号（$）开始。未初始化的实例变量的值为 nil
    e.常量:Ruby常量以大写字母开头。定义在类或模块内的常量可以从类或模块的内部访问，定义在类或模块
    外的常量可以被全局访问。
    d.伪变量
        self: 当前方法的接收器对象。
        true: 代表 true 的值。
        false: 代表 false 的值。
        nil: 代表 undefined 的值。
        __FILE__: 当前源文件的名称。
        __LINE__: 当前行在源文件中的编号


2.方法
    a.构造方法 initialize
    b.成员方法
    c.类方法
=end

class Customer
  $global_variable = 10 #全局变量
  @@no_of_customers = 10 #类变量
  VAR1 = 100      #常量
  attr_accessor :cust_id,:cust_name,:cust_addr
  
  #构造方法
  def initialize(id, name, addr)
            @cust_id=id         #实例变量
            @cust_name=name
            @cust_addr=addr
  end
  
  #成员方法
  def fun
    puts "I am Fun"
  end
  
  #类方法
  def self.fun
    puts "This is fun"
  end
  
end

#实例变量访问 obj.属性名
Customer.new(1,'zhangsan',1).cust_addr()

#类变量    不能获取

#常量 class::属性名
Customer::VAR1

#成员方法
Customer.new(1,'zhangsan',1).fun

#类方法  class::类方法
Customer::fun()



#------------------------------------模块--------------------------------#
=begin
  模块（Module）定义了一个命名空间，相当于一个沙盒
  模块（Module）是一种把【类方法】、【类】和【常量】，【普通方法】组合在一起的方式。
  模块类似与类，但有一下不同：
    (1)模块不能实例化
    (2)模块没有子类
    (3)模块只能被另一个模块定义
=end

module Person
       PI=3.14  #模块常量
  
       def self.sin  #模块类方法
        puts "sin"
       end
   
       def  fun     #模块普通方法
        puts "fun"
       end
       
       class Student  #模块类
       end
end

#模块常量   module::常量
Person::PI

#模块类方法 module::类方法
Person::sin

#模块普通方法 只能被类继承

#模块类 module::类.new
Person::Student.new



#--------------------------------控制访问---------------------------#
=begin
  Ruby 为您提供了三个级别的【实例方法】保护，分别是 public、private 或 protected。
  Ruby不在实例和类变量上应用任何访问控制。

  public方法，可以被定义它的类和其子类访问，可以被类和子类的实例对象调用；
  protected方法，可以被定义它的类和其子类访问，不能被类和子类的实例对象直接调用，但是可以在类和子
  类中指定给实例对象；
  private方法，可以被定义它的类和其子类访问，私有方法不能指定对象。
=end
class Person 
      
    def speak 
          "protected:speak " 
    end  
    def laugh 
          "private:laugh" 
    end 

    protected :speak 
    private :laugh 

    def useLaugh(another) 
         puts another.laugh #这里错误，私有方法不能指定对象
    end 
    def useSpeak(another) 
         puts another.speak 
    end 
end 

  p1=Person.new 
  p2=Person.new 
  p2.useSpeak(p1)  # protected:speak
  #p2.useLaugh(p1)
  
  
  
#----------------------------------继承------------------------------#
#1.类的继承
class Box
end
 
# 定义子类
class BigBox < Box
end

#2.Mixins
=begin
  Ruby 没有真正实现多重继承机制，而是采用成为mixin技术作为替代品。将模块include
到类定义中，模块中的方法就mix进了类中。
=end
module A
     def a1
     end
end

module B
     def b1
     end
end
 
class Sample
  include A
  include B
    def s1
    end
end

#3.祖先链
=begin
  祖先链用于描述Ruby对象的继承关系，因为类与模块是父子关系，所以祖先链中也可以包含模块通过
Class.ancestors可以查看当前的祖先链

 类对象   class=> [Class, Module, Object, Kernel, BasicObject]
=end
module A
end
    
class B
end
    
class C<B
  include A
end
puts C.ancestors
#>[C,A,B,Object,Kernel,BasicObject]
  


#--------------------------------重写与重载------------------------------------#
#重写
class Box
    def getArea
        puts "Box"
    end
end
 
class BigBox < Box
      def getArea
          puts "BigBox"
      end
      
      # 重写to_s 方法
       def to_s
          "(w:#@width,h:#@height)"  # 对象的字符串格式
       end
end

#重载，ruby不支持重载，但可以用可变参数
def sample (*test)
     puts "参数个数为 #{test.length}"
     for i in 0...test.length
        puts "参数值为 #{test[i]}"
     end
  end
sample "Zara", "6", "F"
sample "Mac", "36", "M", "MCA"


#------------------------------多态-----------------------------#
#ruby没有接口概念，而是通过mixin模块来实现扩展，同样可以实现多态
module Laugh
 def laugh
   puts "hahaha"
 end
end

class Cat
  include Laugh
  def laugh
    puts "mio mio!"
  end
end

class Dog
  include Laugh
  def laugh
    puts "wang wang!"
  end
end

cat = Cat.new
dog = Dog.new
cat.laugh;#mio mio!
dog.laugh;#wang wang!