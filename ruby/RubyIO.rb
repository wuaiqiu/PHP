#-------------------------加载类（模块）文件-------------------------#
=begin
(1)require 语句（加载文件）
  多引入外部rb源文件或者外部库（可以省略文件的后缀‘.rb’），require加载外部文件只会加载一次（多次引入会忽略）
        
  require 'trig.rb'
  require 'moral'  
  
        
(2)load（加载文件）
  与require相比，除了会加载多次外，加载时需要添加文件的后缀名
  load 'trig.rb'
  load 'moral.rb'
  
        
(3)include 语句（加载模块）
  您可以在类中嵌入模块。为了在类中嵌入模块，您可以在类中使用 include 语句

        module Week
        end
  
        class Decade
          include Week # 在使用require时，请求加载的内容放到引号里，而inclue不是用引号
        end
	
	=>[Decade,Week,Object,Kernel,BasicObject]
  
              
(4)prepend（加载模块）
 	=>[Week,Decade,Object,Kernel,BasicObject]
=end    