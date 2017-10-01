#------------------------------函数定义---------------------------#
#(1)简单的方法
def method_name 
   
end
 

 
#(2)接受参数的方法
def method_name (var1, var2)
    
end
  


#(3)参数设置默认值
def method_name (var1=value1, var2=value2)
     
end



#(4)return 语句,默认ruby方法都有返回值，默认返回最后一个变量
def test
     i = 100
     j = 200
     k = 300
     return i, j, k
end
var = test
#>[100,200,300]



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
  method_missing利用的机制是，当一个对象进行某个方法调用的时候，会到其对应的类的实例方法中进行查
找，如果没有找到，则顺着祖先链向上查找，直到找到BasicObject类为止。如果都没有则会最终调用一个
BasicObject#method_missing抛出NoMethodError异常。
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
  undef_method会删除所有(包括继承而来的)方法。而remove_method只删除接受者自己的方法，而保留继
承来的方法。
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
    
 
    
#-------------------------------自由方法--------------------------------#
=begin
(1)通过Kernel#method方法，可以获得一个用Method对象表示的方法，在之后可以用Method#call方法对其
进行调用。
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
  它会从最初定义它的类或模块中脱离出来(即脱离之前的作用域)，可以将一个方法变为自由方法。通过调用
Module#instance_method获得一个自由方法（UnboundMethod对象），通过UnboundMethod#bind方法把
UnboundMethod对象绑定到一个对象上；从某个类中分离出来的UnboundMethod对象只能绑定在该类及其子类
对象上，从模块中分离出来的UnboundMethod对象不在有此限制了。
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

    
    
#--------------------------------单件方法----------------------------#
=begin
单件方法
  Ruby允许给单个对象增加方法,这种只针对单个对象生效的方法，称为单件方法
  
  (1)定义方式
    Object#define_singleton_method
    Object#singleton_methods 
    
  (2)Ruby中class也是对象，则类方法也是一个类的单件方法
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
  (1)单件类
  单件方法也不能在祖先链的某个位置中。正确的位置是在单件类中
  每个单件类只有一个实例（被称为单件类的原因），而且不能被继承
  每个对象都有一个单件类
  类方法其实质是生活在该类的单件类中的单件方法

      class MyClass
            class << self
                def yet_another_class_method
                end
            end
      end
  
  (2)引入单件类后的方法查找
        单件类 => 祖先链

  (3)一个对象的单件类的超类是这个对象的类；一个类的单件类的超类是这个类的超类的单件类。(单件类.png)
=end

#获取单件类Object#singleton_class
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
  
  
  
#----------------------------------模块与单件类----------------------------#
=begin
    当一个类包含一个模块时，他获得的是该模块的【实例方法】，而不是【类方法】。【类方法】存
在与模块的【单件类】中，没有被类获得

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
  Ruby中使用Module#alias_method(:newName,:oldName)方法和alias(:newName :oldName)关键字
为方法取别名。
  在顶级作用域中（main【Object, Kernel, BasicObject】）中只能使用alias关键字来命名别名，因为
在那里调用不到Module#alias_method方法
  注意:在alias出现循环时，只看第一条alias语句
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
    prepend是插入到下方，而下方的位置，正好是方法查找时优先查找的位置，利用这一优势，可以覆写
当前类的同名方法
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
=end

#(1)Class#inherited当一个类被继承时，Ruby会调用该方法
class A
    def self.inherited(arg1)
          puts "A被#{arg1}继承"
    end
end

class B <A
end
#=>A被B继承


#(2)Module#included(Module#prepended)
module A
    def A.included(args)
      puts "#{args}"
    end 
end

class B
  include A
end
#=>B


#(3)Module#extend_object
module A
  def A.extend_object(arg1)
    puts "#{arg1}"
  end
end

class B
  extend A
end
#=>B


#(4)Module#method_added(Module#method_removed或Module#method_undefined)
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


#(5)BasicObject#singleton_method_added(BasicObject#singleton_method_remove或BasicObject#singleton_method_undefined)



#----------------------------eval方法--------------------------------------#
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
  (1)与BasicObject#instance_eval和Module#class_eval相比Kernal#eval更加直接，不需要代码块、
直接就可以执行字符串代码(String of Code)。
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