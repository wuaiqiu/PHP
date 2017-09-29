#(1)if..elsif..else
  x=1
  if x > 2
     puts "x 大于 2"
  elsif x <= 2 and x!=0
     puts "x 是 1"
  else
     puts "无法得知 x 的值"
  end

#..if..
  $a=1
  print "debug\n" if $a



#(2)case..when..else..end
  $age =  5
  case $age
  when 0 .. 2
      puts "婴儿"
  when 3 .. 6
      puts "小孩"
  when 7 .. 12
      puts "child"
  when 13 .. 18
      puts "少年"
  else
      puts "其他年龄段的"
  end

  
  
#(3)while..do..end
  $i = 0
  $num = 5
  while $i < $num  do
     puts("在循环语句中 i = #$i" )
     $i +=1
  end

#begin..end while..
  $i = 0
  $num = 5
  begin
     puts("在循环语句中 i = #$i" )
     $i +=1
  end while $i < $num

  
  
#(4)for..in..end
  for i in 0..5
    puts "局部变量的值为 #{i}"
  end

#().each do..end
(0..5).each do |i|
   puts "局部变量的值为 #{i}"
end



#(5)break,next,redo
for i in 0..5
   if i > 2 then
      break
   end
   puts "局部变量的值为 #{i}"
end

=begin
>局部变量的值为 0
>局部变量的值为 1
>局部变量的值为 2
=end


for i in 0..5
   if i < 2 then
      next
   end
   puts "局部变量的值为 #{i}"
end

=begin
>局部变量的值为 2
>局部变量的值为 3
>局部变量的值为 4
>局部变量的值为 5
=end


for i in 0..5
   if i < 2 then
      puts "局部变量的值为 #{i}"
      redo
   end
end 

=begin
>局部变量的值为 0
>局部变量的值为 0
>...
=end