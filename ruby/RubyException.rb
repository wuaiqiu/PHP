=begin
Ruby 异常

  begin 
     #抛出异常
  rescue  => e #显式指定异常对象
       $! #表示异常信息
       $@ #表示异常出现的代码位置
  retry # 这将把控制移到 begin 的开头
  ensure 
    #不管有没有异常，进入该代码块
  end 

=end

begin
    a=1/0
    raise 'A test exception.'
    rescue Exception => e
      puts e.message
      puts e.backtrace.inspect
    ensure
      puts "Ensuring execution"
end