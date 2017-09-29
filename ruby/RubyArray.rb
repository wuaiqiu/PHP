=begin
数组(Array)
    Ruby数组是任何对象的有序整数索引集合。数组的索引从0开始。一个负数的索相对于数组的末尾计数的。
    Ruby数组不需要指定大小，当向数组添加元素时，Ruby数组会自动增长。


    a)创建数组
      names = Array.new
      names = Array.new(20)
      names = Array.new(2,"defaultValue")
      nums = Array[1, 2, 3, 4,5]
      nums = [1,2,3]
  
  
    b)Array方法 
      array[index]
      array.at(index)
      array[start, length]
      array[range]
      array.slice(index) 
      array.slice(start, length)
      array.slice(range)
      返回索引为 index 的元素，或者返回从 start 开始直至 length 个元素的子数组，或者返回 range 
      指定的子数组。负值索引从数组末尾开始计数（-1 是最后一个元素）。如果 index（或开始索引）超出
      范围，则返回 nil。

      array.clear
      从数组中移除所有的元素。

      array.collect { |item| block }
      array.map { |item| block }
      为self中的每个元素调用一次 block。创建一个新的数组，包含 block 返回的值。

      array.each { |item| block }
      为self中的每个元素调用一次 block，单独返回每次的block
    
      array.delete_at(index)
      删除指定的 index 处的元素，并返回该元素。如果 index 超出范围，则返回 nil。

      array.empty?
      如果数组本身没有包含元素，则返回 true。

      array.length
      array.size
      返回 self 中元素的个数。可能为零。

      array.reverse
      返回一个新的数组，包含倒序排列的数组元素。

      array.join(sep=$,)
      返回一个字符串，通过把数组的每个元素转换为字符串，并使用 sep 分隔进行创建的。


     c)运算符
      array & other_array
      返回一个新的数组，包含两个数组中共同的元素，没有重复。
        
      array | other_array
      通过把 other_array 加入 array 中，移除重复项，返回一个新的数组。
        
      array + other_array
      返回一个新的数组，新数组通过连接两个数组产生第三个数组创建的。含有重复
        
      array * int [or] array * str
      返回一个新int倍的数组，带有 String 参数时，相当于 self.join(str)
        
      array - other_array
      返回一个新的数组，新数组是从初始数组中移除了在 other_array 中出现的项的副本。
        
      array << obj
      把给定的对象附加到数组的末尾。该表达式返回数组本身，所以几个附加可以连在一起。

      array <=> other_array
      如果数组小于、等于或大于 other_array，则返回一个整数（-1、 0 或 +1）。

      array == other_array
      如果两个数组包含相同的元素个数，且每个元素与另一个数组中相对应的元素相等
      （根据 Object.==），那么这两个数组相等。
=end