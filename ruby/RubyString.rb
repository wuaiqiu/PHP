=begin
一.字符串类型(String)
    (1)双单引号的区别
        双引号标记的字符串允许替换和使用反斜线符号.
        单引号标记的字符串不允许替换，且只允许使用 \\ 和 \' 两个反斜线符号。  
        ============================================================
                  puts 'escape using "\\"';
                  puts 'That\'s right';
                  
                  >escape using "\"
                  >That's right
        =============================================================
    
    (2)#{expr}
        #{expr} 替换任意 Ruby 表达式的值为一个字符串,在双引号中见效
        =============================================================
                  puts "相乘 : #{24*60*60}";
                  >相乘 : 86400
        =============================================================
    
    (3)字符的另一种表示方式
        %q 使用的是单引号引用规则，而 %Q 是双引号引用规则，后面再接一个 (! [ { 等等
        =============================================================
                desc1 = %Q{Ruby 的字符串可以使用 '' 和 ""。}
                desc2 = %q|Ruby 的字符串可以使用 '' 和 ""。|
        =============================================================
  
     (4)String方法
          str.empty?
          如果 str 为空（即长度为 0），则返回 true。
      
          str.length
          返回 str 的长度。把它与 size 进行比较。
        
          str.to_f
          返回把 str 中的前导字符解释为浮点数的结果。

      (5)String运算符
        str * integer
        返回一个包含 integer 个 str 的新的字符串。换句话说，str 被重复了 integer 次。
        
        str + other_str
        连接 other_str 到 str。
        
        str <=> other_str
        把 str 与 other_str 进行比较，返回 -1（小于）、0（等于）或 1（大于）。比较是区分大小写的。

        str == obj
        检查 str 和 obj 的相等性。如果 obj 不是字符串，则返回 false，如果 str <=> obj，则返回 true，
        返回 0。

二.Symbol类型
  
    a.每个 String 对象都是不同的，即便他们包含了相同的字符串内容；而对于 Symbol 对象，一个名字
（字符串内容）唯一确定一个 Symbol 对象。
        =========================================================
                puts :foo.object_id
                327458
                puts :foo.object_id
                327458
                puts :"foo".object_id
                327458
                
                puts "foo".object_id
                24303850
                puts "foo".object_id
                24300010
        ==========================================================

   b.Symbol 转化为 String
    使用 to_s 或 id2name 方法将 Symbol 转化为一个 String 对象
        ==========================================================
                :"I am a boy".to_s
                =>"I am a boy"
        ==========================================================

   c.String 转化为 Symbol
    除了在字符串前面加冒号，还可以使用 to_sym 或 intern 方法将 String 转化为 Symbol ，
    如果该 Symbol 已经存在，则直接返回。
        ===========================================================
                  var1 = "test".to_sym
                  => :test
        ===========================================================

=end