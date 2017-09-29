=begin
数组(Array)
    Ruby 数组是任何对象的有序整数索引集合。数组中的每个元素都与一个索引相关，并可通过索引进行获取。
数组的索引从 0 开始，这与 C 或 Java 中一样。一个负数的索相对于数组的末尾计数的
    Ruby 数组不需要指定大小，当向数组添加元素时，Ruby 数组会自动增长。

  a)创建数组
    names = Array.new
    names = Array.new(20)
    
  b)赋值
    names = Array.new(4, "mac")
    puts "#{names}"   //["mac", "mac", "mac", "mac"]

    //带有 new 的块，每个元素使用块中的计算结果来填充
    nums = Array.new(10) { |e| e = e * 2 }
    puts "#{nums}"      //[0, 2, 4, 6, 8, 10, 12, 14, 16, 18]

    nums = Array.[](1, 2, 3, 4,5)

    nums = Array[1, 2, 3, 4,5]

    nums = [1,2,3]

    array << obj1 << obj2   //把给定的对象附加到数组的末尾。该表达式返回数组本身，所以几个附加可以连在一起。
  
  -------------------------------------Array方法---------------------------------
        
    array[index]
    array[start, length]
    array[range]
    array.slice(index) 
    array.slice(start, length)
    array.slice(range)
    返回索引为 index 的元素，或者返回从 start 开始直至 length 个元素的子数组，或者返回 range 指定的子数组。负值索引从数组
    末尾开始计数（-1 是最后一个元素）。如果 index（或开始索引）超出范围，则返回 nil。

    array.at(index)
    返回索引为 index 的元素。一个负值索引从 self 的末尾开始计数。如果索引超出范围则返回 nil。

    array.clear
    从数组中移除所有的元素。

    array.collect { |item| block }
    array.map { |item| block }
    为 self 中的每个元素调用一次 block。创建一个新的数组，包含 block 返回的值。

    array.delete_at(index)
    删除指定的 index 处的元素，并返回该元素。如果 index 超出范围，则返回 nil。

    array.each { |item| block }
    为 self  中的每个元素调用一次 block，传递该元素作为参数。 

    array.empty?
    如果数组本身没有包含元素，则返回 true。

    array.length
    返回 self 中元素的个数。可能为零。

    array.reverse
    返回一个新的数组，包含倒序排列的数组元素。
        
    array.size
    返回 array 的长度（元素的个数）。length 的别名。
=end