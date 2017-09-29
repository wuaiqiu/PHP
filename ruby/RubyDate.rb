=begin      
(1)获取时间
      time1 = Time.new
      puts "当前时间 : " + time1.inspect
 
      #Time.new 功能相同
      time2 = Time.now
      puts "当前时间 : " + time2.inspect
 
      
      
(2)Time方法
      puts "当前时间 : " + time.inspect   #转换为字符串
      puts time.year                     # => 日期的年份
      puts time.month                    # => 日期的月份（1 到 12）
      puts time.day                      # => 一个月中的第几天（1 到 31）
      puts time.wday                     # => 一周中的星期几（0 是星期日）
      puts time.hour                     # => 23：24 小时制
      puts time.min                      # => 59
      puts time.sec                      # => 59     



(3)格式化时间和日期
      puts time.strftime("%Y-%m-%d %H:%M:%S")
      #>2017-09-11 09:43:02
=end