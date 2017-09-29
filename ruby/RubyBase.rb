=begin
      ruby是解释型语言，动态语言
      静态语言，在编译阶段，编译器都会检查方法调用的对象是否有一个这样的方法，如果没有就直接报错
      动态语言，只有真正调用这个方法的时候，找不到这个方法才会报错错误，



  (1)设置编码
  ====================================================
    #!/usr/bin/ruby -w
    #coding=utf-8
 
    puts "你好，世界！";
  ====================================================



  (2)ruby的结束
    Ruby 把分号和换行符解释为语句的结尾。但是，如果 Ruby 在行尾遇到运算符，比如 +、- 或反斜杠，
它们表示一个语句的延续。
  
  

  (3)Ruby 中的 Here Document
    如果终止符用引号括起，引号的类型决定了面向行的字符串类型
  ====================================================
    print <<EOF
        这是第一种方式创建here document 。
        多行字符串。
    EOF
   ====================================================
    print <<"EOF"                # 与上面相同
        这是第二种方式创建here document 。
        多行字符串。
    EOF
   ====================================================
    print <<`EOF`                 # 执行命令,是esc下的" ` "
        echo hi there
        echo lo there
    EOF
  ====================================================
  


  (4)Ruby BEGIN END语句
  ====================================================
    puts "这是主 Ruby 程序"
 
    END {
       puts "停止 Ruby 程序"
    }
    BEGIN {
       puts "初始化 Ruby 程序"
    }

    >初始化 Ruby 程序
    >这是主 Ruby 程序
    >停止 Ruby 程序
  ====================================================



  (5)Ruby 注释
    
    # 我是注释，请忽略我。

    =begin
    这是注释。
    这也是注释。
    这也是注释。
    这还是注释。
    =end



   (6)输出与输入
        a.puts 输出语句，将在每行末尾添加一个换行符
          val1 = "This is variable one"
          val2 = "This is variable two"
          puts val1
          puts val2

        b.gets 语句可用于获取来自名为 STDIN 的标准屏幕的用户输入。
          puts "Enter a value :"
          val = gets
          puts val

        c.print 输出语句，不会再每行末尾添加一个换行符
=end