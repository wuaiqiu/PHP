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
      
=end

begin
        a=1/0
    rescue => e
      puts e.message
      puts e.backtrace.inspect
    ensure
      puts "Ensuring execution"
end