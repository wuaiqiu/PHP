=begin
ruby调用执行shell命令
  
  (1)Kernel#exec方法通过调用指定的命令取代当前进程(退出当前ruby环境，不在执行后面的ruby代码，
  执行shell命令),主要的缺点是，你无法从你的ruby脚本里知道这个命令是成功还是失败。
  
  (2) Kernel#system方法操作命令同上， 但是它是运行一个子shell来避免覆盖当前进程。如果
  命令执行成功则返回true，否则返回false。

  (3)反引号,它也是运行在一个子shell中。
  
=end



exec "date" #=>2017年 10月 09日 星期一 18:37:00 CST

obj = system "date" #=>2017年 10月 09日 星期一 18:40:56 CST
puts obj #=>true

puts `date` #=>2017年 10月 09日 星期一 18:45:01 CST