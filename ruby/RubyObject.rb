#------------------------------类属性与方法----------------------------#
=begin
1.属性
    a.局部变量：局部变量是在方法中定义的变量。局部变量在方法外是不可用的。局部变量以小写字母或 _ 开
始。
    b.实例变量：实例变量在变量名之前放置符号（@）。未初始化的实例变量的值为 nil;
          实例变量的访问器(getter) & 设置器(setter)方法
            attr_accessor :variable_name
            attr_reader :variable_name
            attr_writer :variable_name 
    c.类变量：类变量属于类，且是类的一个属性。类变量在变量名之前放置符号（@@）。必须初始化后才能在
方法定义中使用，类变量在定义它的类或模块的子类或子模块中可共享使用。
    d.全局变量：类变量不能跨类使用。如果您想要有一个可以跨类使用的变量，您需要定义全局变量。全局变量
总是以美元符号（$）开始。未初始化的实例变量的值为 nil
    e.常量:Ruby常量以大写字母开头。定义在类或模块内的常量可以从类或模块的内部访问，定义在类或模块外
的常量可以被全局访问。
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
  @@no_of_customers=10 #类变量
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



#-----------------------------作用域------------------------------------#
=begin
作用域
  Ruby中不具备嵌套作用域(即在内部作用域，可以看到外部作用域的)的特点，它的作用域是截然分开的，一旦进入一个
新的作用域，原先的绑定会被替换为一组新的绑定。类定义class 模块定义 module  方法定义 def

(1)扁平化作用域（局部变量）
    Class.new替代class
    Module#define_method代替def
    Module.new代替module
=end

  my_var = "Success"
  MyClass = Class.new do
        puts "#{my_var} in  the class definition"

        define_method :my_method do
            puts "#{my_var} in the method"
        end
  
  end

  obj2=MyClass.new
  obj2.my_method

  
=begin
(2)BasicObject#instance_eval{代码块}
    可以访问到调用者对象中的变量（实例变量）
=end
  class MyClass

    def initialize
          @v = 1
        end

  end

  obj = MyClass.new
  puts obj.instance_eval { @v } 
  obj.instance_eval{@v=3}
  puts obj.instance_eval { @v } 

    
=begin
(3)BasicObject#instance_exec(参数){|参数列表| }
    与instance_eval一样
=end

  class C
        def initialize
            @x = 1
        end
  end
  class D
        def twisted_method
            @y = 2
            C.new.instance_exec(@y) { |y| "@x: #{@x}, @y: #{y}"}
        end
  end
  
  puts D.new.twisted_method  
  #>@x: 1, @y: 2



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
  protected方法，可以被定义它的类和其子类访问，不能被类和子类的实例对象直接调用，但是可以在类和子类中指定给实例对象；
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
  祖先链用于描述Ruby对象的继承关系，因为类与模块是父子关系，所以祖先链中也可以包含模块通过Class.ancestors可以
查看当前的祖先链

==================================================================
 类对象   class=> [Class, Module, Object, Kernel, BasicObject]
==================================================================
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



#----------------------------动态方法---------------------------------#
=begin
(1)动态调用方法  
    在Ruby中通过Object#send方法可以代替点标识调用对象的指定实例方法
=end

    class MyClass
          def get1
          puts "get1"
      end
    
      def get2
         puts "get2"  
      end

      def get3
         puts "get3"
      end
    end

    obj = MyClass.new
    name = 1
    obj.send(:"get#{name}") #=>get1

=begin
  上面代码通过直接调用和使用send方法调用得到的结果是一样的
  通过Object#send不仅可以调用公共方法，也可以调用对象的私有方法。
  如果想保留对象的封装特性，不向外暴露私有方法可以使用Object#public_send方法。
=end

    
    
=begin
(2)动态定义方法
  通过Module#define_method方法和代码块提供了动态方法定义方式
=end
    
    class MyClass
          define_method :get do |arg|
              puts "get#{arg}"
            end
    end

    obj = MyClass.new
    obj.get(1)  #=> get1

    
     
=begin 
(3)method_missing方法
  method_missing利用的机制是，当一个对象进行某个方法调用的时候，会到其对应的类的实例方法中进行查找，如果没有找到，则顺着祖先链向上查找，直到找
到BasicObject类为止。如果都没有则会最终调用一个BasicObject#method_missing抛出NoMethodError异常。
=end
    class SendClass  
        def method_missing(name, *argc)  
            if [:one_name, :two_name, :three_name].include?(name)  
                name  
            else  #处理不了的方法就让父类处理  
                super  
            end  
        end  
    end  
  
    s = SendClass.new  
    puts s.one_name    #one_name  
    puts s.four_name   #undefined method `four_name'  

 
    
=begin
(4)删除方法
=end
   class A
        def fun1
              puts "ok"
        end
    end

    class B<A
        def fun1
            puts "ok1"
            end
          
        remove_method :fun1
    end

    B.new.fun1
    #>ok
    
  #undef_method会删除所有(包括继承而来的)方法。而remove_method只删除接受者自己的方法，而保留继承来的方法。
 

    
#-------------------------------Methode对象---------------------------#
=begin
(1)通过Kernel#method方法，可以获得一个用Method对象表示的方法，在之后可以用Method#call方法对其进行调用。
=end  
  class A
    def fun
      puts "this is fun"
    end
  end
  
  obj1=A.new
  m=obj1.method :fun
  m.call

=begin
(2)自由方法
  它会从最初定义它的类或模块中脱离出来(即脱离之前的作用域)，可以将一个方法变为自由方法。
通过调用Module#instance_method获得一个自由方法（UnboundMethod对象），通过UnboundMethod#bind
方法把UnboundMethod对象绑定到一个对象上；从某个类中分离出来的UnboundMethod对象只能绑定在该类及
其子类对象上，从模块中分离出来的UnboundMethod对象不在有此限制了。
=end
  class A
    def fun
          puts "this is fun"
      end
  end

  um=A.instance_method :fun
  obj=A.new
  m=um.bind obj
  m.call

    
    
#--------------------------------单件方法-------------------------#
=begin
单件方法
  
  Ruby允许给单个对象增加方法,这种只针对单个对象生效的方法，称为单件方法
  
  定义方式
  Object#define_singleton_method
  Object#singleton_methods 
    
  Ruby中class也是对象，则类方法也是一个类的单件方法
      def ClassName.fun
      end

      ClassName.define_singleton_method(:fun){}
=end
  class A
  end

  obj=A.new

  #方法一
  def obj.fun
      puts "this is fun"
  end
  obj.fun #=>this is fun
  puts obj.singleton_methods  #=>fun

  #方法二
  obj.define_singleton_method(:fun2) { puts "this is fun2" }
  obj.fun2  #=>this is fun2
  puts obj.singleton_methods  #=>fun fun2

 
#-----------------------------单件类------------------------------#
=begin
  单件方法也不能在祖先链的某个位置中。正确的位置是在单件类中
  每个单件类只有一个实例（被称为单件类的原因），而且不能被继承
  每个对象都有一个单件类
  类方法其实质是生活在该类的单件类中的单件方法
  -----------------------------------------------------
  class MyClass
        class << self
            def yet_another_class_method
      end
        end
  end
  ----------------------------------------------------

  （1）获取单件类
  Object#singleton_class
=end
  class A
  end

  obj=A.new
  
  #方法一
  s=class << obj
    self
  end
  puts s.class        #=>Class

  #方法二
  puts obj.singleton_class  #=>Class

=begin
  （2）引入单件类后的方法查找

  单件类 => 祖先链

  (3)一个对象的单件类的超类是这个对象的类；一个类的单件类的超类是这个类的超类的单件类。(单件类.png)
=end
  
  
  
#----------------------------------模块与单件类----------------------------#
=begin
当一个类包含一个模块时，他获得的是该模块的【实例方法】，而不是【类方法】。
  【类方法】存在与模块的【单件类】中，没有被类获得

  （1）类扩展
  通过向类的单件类中添加模块来定义类方法
=end
  
  module A
      def fun
           puts "ok"
    end
  end

  class B
       class <<  self
              include A
     end
  end
  #-------------------------或者---------------------------
  class B
     extend A
  end
  
  B.fun()

=begin
  （2）对象扩展
  类方法是单件方法的特例，因此可以把类扩展这种技巧应用到任意对象上，这种技巧即为对象扩展
=end
  
  module A
    def fun
      puts "ok"
    end
  end

  obj=Object.new
  class << obj
    include A
  end
  #-------------------------------或者---------------------------
  obj.extend A

  obj.fun

  
  
#-------------------------方法包装器（Method Wrapper）--------------------#
=begin
(1)方法别名
  Ruby中使用Module#alias_method(:newName,:oldName)方法和alias(:newName :oldName)关键字为方法取别名。
=end
  class A
    def fun
      puts "this is fun"
    end
  
    alias_method :fun1,:fun
  end

  obj=A.new
  obj.fun #=>this is fun
  obj.fun1#=>this is fun

=begin  
  在顶级作用域中（main【Object, Kernel, BasicObject】）中只能使用alias关键字来命名别名，因为在那里调用不到Module#alias_method方法
  注意:在alias出现循环时，只看第一条alias语句
=end


=begin  
(2)环绕别名
    a.给方法定义一个别名
    b.重定义这个方法
    c.在新的方法中调用老的方法
=end
  class A
    def fun
      puts "this is origin function"
    end
    private :fun

    def fun2    #b.重定义这个方法
      puts "this is head"
      fun1      #c.在新的方法中调用老的方法
      puts "this is footer" 
    end
    
    alias :fun1 :fun  #a.给方法定义一个别名
    alias :fun :fun2
  end
  
  A.new.fun
 

=begin  
(3)细化(refine)  
  细化的作用范围是文件末尾，而环绕别名则是作用在全局
=end
  
  module StringRefinement
      refine String do
          def length
              super > 5 ? 'long' : 'short'
          end
      end 
  end

  puts "War and Peace".length #=>13

  using StringRefinement

  puts "War and Peace".length  #=> “long”
 

=begin
(4)下包含包装器 (Module#prepend)
    prepend是插入到下方，而下方的位置，正好是方法查找时优先查找的位置，利用这一优势，可以覆写当前类的同名方法
=end
  
  module ExplicitString
        def length
            super > 5 ? ‘long’ : ‘short’
        end
  end

  String.class_eval do
    prepend ExplicitString
  end

  puts "War and Peace".length  #=> “long”

  
  
#----------------------------------钩子方法---------------------------------------#
=begin
  钩子方法有些类似事件驱动装置，可以在特定的事件发生后执行特定的回调函数，这个回调函数就是钩子方法
(1)Class#inherited
  当一个类被继承时，Ruby会调用该方法
=end
class A
    def self.inherited(arg1)
          puts "A被#{arg1}继承"
    end
end

class B <A
end
#=>A被B继承

=begin
(2)Module#included(Module#prepended)
=end
module A
    def A.included(args)
      puts "#{args}"
    end 
end

class B
  include A
end
#=>B

=begin
(3)Module#extend_object
=end
module A
  def A.extend_object(arg1)
    puts "#{arg1}"
  end
end

class B
  extend A
end
#=>B

=begin
(4)Module#method_added(Module#method_removed或Module#method_undefined)
=end
module A
    def A.method_added(arg1)
      puts "#{arg1}"
    end
    def fun
    end 
end
#=>fun

module A
    def A.method_added(arg1)
      puts "#{arg1}"
    end
    def fun
    end 
    remove_method :fun
end
#=>fun

module A
    def A.method_added(arg1)
      puts "#{arg1}"
    end
    def fun
    end 
    undef_method :fun
end
#=>fun

=begin
(5)BasicObject#singleton_method_added(BasicObject#singleton_method_remove或
BasicObject#singleton_method_undefined)
=end



#-----------------------eval-----------------------------------#
=begin
BasicObject#instance_eval 与 Module#class_eval
    instance_eval必须由实例来调用
    class_eval必须由类来调用
=end

  class A
      def self.fun1
          puts @var
      end
  
    def fun2
          puts @var
      end
  end

  obj=A.new
  
  #由于A类是Class类的一个实例，因此就定义了A类的单件方法m1，进而m1只会对A类的实例变量进行操作。
  A.instance_eval do
     def m1
        @var=1
     end
  end
  
  #由于obj是A类的一个实例，因此就定义了obj实例的单件方法m2，进而只会对obj的实例变量进行操作。
  obj.instance_eval do
      def m2
          @var=2
      end
  end
  
  #由于定义了A类的实例方法m3，因此只会对obj的实例变量进行操作。
  A.class_eval do
      def m3
          @var=3
      end
  end

  A.m1  
  A.fun1 #=>1
  
  obj.m2 
  obj.fun2  #=>2

  obj.m3  #=>A.class_eval
  obj.fun2#=>3
 
   
=begin
Kernal#eval方法
  (1)与BasicObject#instance_eval和Module#class_eval相比Kernal#eval更加直接，不需要代码块、直接就可以
执行字符串代码(String of Code)。
  BasicObject#instance_eval也是可以执行字符串代码的。
=end
  
  eval "puts 'ok'"    #ok
  instance_eval "puts 'ok'" #ok
 
  
=begin
  (2)绑定对象
  Binding是一个完整作用域对象，通过eval方法在这个Binding对象所携带的作用域内执行代码
=end
  
  class MyClass
      def my_method
          @x = 1
          binding
      end
  end

  b = MyClass.new.my_method
  eval "puts @x", b #=> 1

  
=begin
  (3)TOPLEVEL_BINDING的预定义常量,表示顶级作用域Binding对象
=end  
  
  class A
    def fun
              eval "puts a",TOPLEVEL_BINDING
    end
  end

  a=3
  A.new.fun   #=>3

