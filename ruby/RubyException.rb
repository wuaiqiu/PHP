=begin
Ruby 异常
  (1)使用一个或多个rescue语句告诉Ruby希望处理的异常类型
      begin 
            #抛出异常
      rescue  => e      #显式指定异常对象
           $!           #表示异常信息
           $@           #表示异常出现的代码位置
           retry        #重新执行retry,可能会导致无限循环
      ensure 
                        #不管有没有异常，进入该代码块
      end 

  (2)raise(ExceptionType,Message)或者raise(Message)手动抛出异常
      raise "出现错误"

  (3)catch 和 throw
      throw :MyException
      catch :MyException do
        puts "出现错误"
      end
  
  (4)Exception类:
      Ruby的标准类和模块引发异常。所有的异常类，形成一个层次，在顶部的类异常。包含7种不同类型的
  一个新的水平:

      Interrupt（打断）
      NoMemoryError
      SignalException
      ScriptError
      StandardError(默认)
      SystemExit  

  (5)自定义异常类
        class MyException < Exception
            def message()
              return "MyException错误"
            end
        end

       begin
          raise(MyException,"发生错误")
       rescue MyException=>e
          puts e.message
       end

=end

begin
        a=1/0
    rescue => e
      puts e.message
      puts e.backtrace.inspect
    ensure
      puts "Ensuring execution"
end