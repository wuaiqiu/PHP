#----------------------文件操作--------------------------#
=begin
(1)新建文件
    File::join( item...)
      返回一个字符串，由指定的项连接在一起，并使用 File::Separator（/） 进行分隔。例如：
    File::join("", "home", "usrs", "bin") # => "/home/usrs/bin"

      "r" ：只读，默认
      "r+" ：读写，覆盖型
      "w" ：只写，覆盖型
      "w+" ：读写，覆盖型
      "a" ：只写，追加型
      "a+" ：读写，追加型
=end
        file=File.new(File.join(".","Test.txt"), "w+")
        file.puts("I am Jack")
        file.puts("Hello World")    

     
=begin
(2)读取文件      
=end
        file=File.open(File.join(".","Test.txt"),"r")
        file.each { |line| print "#{file.lineno}.", line }
        file.close

      
=begin
(3)删除、重命名文件 
     File::rename( old, new):改变文件名 old 为 new。

     File::delete( path...):删除指定的文件。
     File::unlink( path...):删除指定的文件。   
=end
      File.rename( "books.txt", "chaps.txt" )
      File.delete( "chaps.txt" )

     
=begin
(4)目录操作    
=end  
      #创建目录
      Dir.mkdir("./testdir")

      #删除目录
      Dir.rmdir("./testdir")

      #查询目录里的文件，返回Array
      Dir.entries(File.join(".","testdir"))

      
=begin
(5)文件信息查询
=end
        #文件是否存在
        p File::exists?( "cnblogslink.txt" ) # => true
        #是否是文件
        p File.file?( "cnblogslink.txt" ) # => true
        #是否是目录
        p File::directory?( "c:/ruby" ) # => true
        p File::directory?( "cnblogslink.txt" ) # => false
        #文件权限
        p File.readable?( "cnblogslink.txt" ) # => true
        p File.writable?( "cnblogslink.txt" ) # => true
        p File.executable?( "cnblogslink.txt" ) # => false
        #是否是零长度
        p File.zero?( "cnblogslink.txt" ) # => false
        #文件大小 bytes
        p File.size?( "cnblogslink.txt" ) # => 74
        p File.size( "cnblogslink.txt" ) # => 74
        #文件或文件夹
        p File::ftype( "cnblogslink.txt" ) # => "file"
        #文件创建、修改、最后一次存取时间
        p File::ctime( "cnblogslink.txt" ) # => Sat Sep 19 08:05:07 +0800 2009
        p File::mtime( "cnblogslink.txt" ) # => Sat Sep 19 08:06:34 +0800 2009
        p File::atime( "cnblogslink.txt" ) # => Sat Sep 19 08:05:07 +0800 2009
        
    
            
#-------------------------加载类（模块）文件-------------------------#
=begin
(1)require 语句（加载文件）
  require 语句类似于 C 和 C++ 中的 include 语句以及 Java 中的 import 语句。如果一个第三方的
程序想要使用任何已定义的模块，则可以简单地使用 Ruby require 语句来加载模块文件
  require 方法允许我们载入一个库并且会阻止你加载多次。当我们使用 require 重复加载同一个library时，
require方法将会返回 false。
        
  $LOAD_PATH << '.'     #$LOAD_PATH << '.' 让 Ruby 知道必须在当前目录中搜索被引用的文件。
  require 'trig.rb'
  require 'moral'  
  
        
(2)load
  load 方法基本和 require 方法功能一致，但它不会跟踪要导入的库是否已被加载。因此当重复使用 load 
方法时，也会载入多次。
  
        
(3)include 语句（加载模块）
  您可以在类中嵌入模块。为了在类中嵌入模块，您可以在类中使用 include 语句

        module Week
        end
  
        class Decade
          include Week # 在使用require时，请求加载的内容放到引号里，而inclue不是用引号
        end
  
              
(4)prepend
  prepend与include分别可以向链中添加模块，不同的是调用include方法，模块会被插入祖先链，当前类的
正上方，而prepend同样是插入到祖先链，但位置其他却在当前类的正下方,
=end    