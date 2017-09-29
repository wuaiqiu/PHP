#(1)简单的方法
def method_name 
   
end
 

 
#(2)接受参数的方法
def method_name (var1, var2)
    
end
  


#(3)参数设置默认值
def method_name (var1=value1, var2=value2)
     
end



#(4)return 语句,默认ruby方法都有返回值，默认返回最后一个变量
def test
     i = 100
     j = 200
     k = 300
     return i, j, k
end
var = test
#>[100,200,300]