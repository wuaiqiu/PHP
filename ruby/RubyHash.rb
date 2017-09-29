=begin
哈希类型
    Ruby 哈希是在大括号内放置一系列键/值对，键和值之间使用逗号和序列 => 分隔。
    


  a)创建哈希
      months = Hash.new
      months={'a'=>1,'b'=>2}    
      months = Hash.new( "defaultValue" )
   


  b)Hash方法
      hash[key]
      使用键，从哈希引用值。如果未找到键，则返回默认值。
      
      hash[key]=value
      把 value 给定的值与 key 给定的键进行关联。
      
      hash.clear
      从哈希中移除所有的键值对。
      
      hash.delete(key) 
      通过 key 从 hash 中删除键值对。

      hash.each { |key,value| block }
      遍历 hash，为每个 key 调用一次 block，传递 key-value 作为一个二元素数组。

      hash.empty?
      检查 hash 是否为空（不包含键值对），返回 true 或 false。

      hash.has_key?(key)
      hash.include?(key)
      hash.key?(key)
      hash.member?(key)
      检查给定的 key 是否存在于哈希中，返回 true 或 false。

      hash.has_value?(value)
      检查哈希是否包含给定的 value。

      hash.invert
      创建一个新的 hash，倒置 hash 中的 keys 和 values。也就是说，在新的哈希中，hash 中的键将
      变成值，值将变成键。

      hash.length
      以整数形式返回 hash 的大小或长度。
      
      hash.to_a
      从 hash 中创建一个二维数组。每个键值对转换为一个数组，所有这些数组都存储在一个数组中。

      hash.to_s
      把 hash 转换为一个数组，然后把该数组转换为一个字符串。

      hash.sort
      把 hash 转换为一个包含键值对数组的二维数组，然后进行排序。
      
      hash.values
      返回一个新的数组，包含 hash 的所有值。
   

 
  c)范围类型
    一个范围表示一个区间。
    两点形式创建一个包含指定的最高值的范围
    三点形式创建一个不包含指定的最高值的范围。

    (1..5)        #==> 1, 2, 3, 4, 5
    (1...5)       #==> 1, 2, 3, 4
=end