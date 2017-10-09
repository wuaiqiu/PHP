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



#(4)return 语句,默认ruby方法返回值将是最后一个语句的值
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
    在Ruby中通过Object#send方法可以代替点标识调用对象的指定【实例方法】
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
          (1..3).each{ |i|
		define_method :"get#{i}" do
              		puts "get#{i}"
	        end
    	  }
    end
    obj = MyClass.new
    obj.get1  #=> get1

    
     
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
UnboundMethod对象绑定到一个对象上,并返回一个Method对象；从某个类中分离出来的UnboundMethod对象
只能绑定在该类及其子类对象上，从模块中分离出来的UnboundMethod对象不在有此限制了。
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

    
    
#----------------------------------单件方法-------------------------------#
=begin
单件方法
  Ruby允许给单个对象增加方法,这种只针对单个对象生效的方法，称为单件方法
  
  (1)定义方式
    Object#define_singleton_method
    Object#singleton_methods 
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
  obj.define_singleton_method(:fun2) {|a,b| puts "this is fun2" }
  obj.fun2  #=>this is fun2
  puts obj.singleton_methods  #=>fun fun2

 
  
#-----------------------------单件类------------------------------#
=begin
  (1)单件类
  单件方法也不能在祖先链的某个位置中。正确的位置是在单件类中
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

  (3)获取单件类Object#singleton_class

=end


  
  
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