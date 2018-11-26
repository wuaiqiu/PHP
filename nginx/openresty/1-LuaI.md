# Lua基础语法I


## 一.基本脚本结构

```lua
#!/usr/bin/lua
--单行注释
--[[
   多行注释
]]

print("Hello Lua")
```

## 二.数据类型

数据类型|描述
--|--
nil|空类型，对于全局变量与table中的元素可以充当删除作用
boolean|布尔类型，true(真)和false(假)。注意在lua中只有false与nil被认为false，其它一律被认为true
number|数值类型
string|字符串类型，字符串行可以用一对双引号或单引号表示，字符串块可以用一对双方括号表示
table|表类型，类似关联数组，默认索引以1开始。支持自动增长
function|函数类型
thread|协程类型
userdata|自定义类型

```lua
print(type("Hello world"))      --string
print(type(10.4*3))             --number
print(type(print))              --function
print(type(true))               --boolean
print(type(nil))                --nil
```

1).Lua是动态脚本语言。<br>
2).Lua运算符:算术运算符[+(加) -(减) *(乘) /(除) %(取余) ^(幂) -(负)]，关系运算符[=(等于) ~=(不等于) >(大于) <(小于) >=(大于等于) <=(小于等于)]，逻辑运算符[and(与) or(或) not(非)]。<br>
3).全局变量:不用local修饰符表示的变量，默认值为nil。<br>
4).局部变量:用local修饰符表示的变量，默认值为nil。<br>
5).支持单值赋值与多值赋值，在多值赋值中，若变量个数>值的个数则按变量个数补足nil。若变量个数<值的个数则多余的值会被忽略。<br>

```lua
--单值赋值
a="Hello"

--多值赋值(即a=10,b=20)
a,b=10,20
```

## 三.流程控制

### while循环

```lua
while(condition)
do
   statements
end
```

### until循环

```lua
repeat
   statements
until(condition)
```

### for循环

```lua
--数值for循环
for i=from,to[,step=1] do  
    statements 
end


--泛型for循环
for key,value in ipairs(arr) do
    statements
end 
```

1).数值for循环:变量i从from到to之间以step递增执行循环体statement，step默认值为1。<br>
2).泛型for循环:key是数组索引值，value是对应索引的数组元素值。ipairs是Lua提供的一个迭代器函数，用来迭代数组。

### if条件

```lua
if(condition)
then
    statements
end


if(condition)
then
    statements1
else
    statements2
end


if(condition1)
then
   statements1
elseif(condition2)
then
    statements2
else
    statements3
end
```

### break与return

```lua
if(condition)
then
  return 1
end
```

## 四.Lua函数

```lua
[local] function name([args...]){
    body
    [return result...]
}

--[[
    1).scope:可选，加修饰符local表示函数是局部函数
    2).name:函数名称
    3).args:可选，声明函数参数，多个参数用逗号隔开
    4).body:函数体
    5).result:可选，函数返回值，多个返回值用逗号隔开
]]
```

### 匿名函数(闭包)

```lua
myprint = function(param)
   print("这是打印函数:",param)
end

--这是打印函数:Hello Lua
myprint("Hello Lua")
```

### 可变参数(...)

```lua
function add(...)  
    local s = 0
    --可变参数长度:5
    print("可变参数长度:",select("#",...))
    for i, v in ipairs({...}) do 
        s = s + v  
    end  
    return s  
end
--25
print(add(3,4,5,6,7))
```

1).普通参数必须放在变长参数之前。<br>
2).select("#",...):返回可变参数长度。<br>
3).select(index,...):返回参数中第index个之后的部分。

## 五.Lua字符串操作

### 常用函数

函数名|描述
--|--
string.len(str)或#str|计算字符串长度
str1...str2|字符串str1与字符串str2连接
string.upper(str)|字符串全部转为大写字母
string.lower(str)|字符串全部转为小写字母
string.format(format,args...)|返回一个类似printf的格式化字符串
string.char(n1,n2..)|将整型数值转化成字符并连接
string.byte(str[,index=1])|将字符串str中位置为index的字符转化成整型(index默认为1)
string.reverse(str)|字符串反转
string.rep(str, n)|返回字符串string的n个拷贝
string.gmatch(str, pattern)|返回一个匹配pattern所有子字符串的数组
string.match(str, pattern[,index=1])|返回第index个匹配pattern子字符串(index默认为1)
string.find(str, pattern)|字符串查找，存在返回其具体位置。不存在则返回nil
string.gsub(str,pattern,new[,n])|字符串替换,将str字符串中的前n个pattern子字符串替换成new子字符串(省略n表示全部替换)

### 模式匹配

字符模式|描述
--|--
.|与任何字符配对
%w|与任何字母/数字配对
%a|与任何字母配对
%u|与任何大写字母配对
%l|与任何小写字母配对
%d|与任何数字配对
%x|与任何十六进制数配对
%c|与任何控制符配对(例如\n)
%s|与空白字符配对
%p|与任何标点(punctuation)配对
%z|与任何代表0的字符配对
[数个字符类]|与任何[]中包含的字符类配对，例如[%w]与任何字母/数字配对
[^数个字符类]|与任何[]中不包含的字符类配对，例如[^%s]与任何非空白字符配对


1).上述的字符类用大写书写时, 表示与非此字符类的任何字符配对。<br>
2).'%'用作特殊字符的转义字符，因此'%.'匹配点；'%%'匹配字符'%'。<br>

长度|描述
--|--
*|将匹配零或多个该类的字符。这个条目总是匹配尽可能长的串
-|将匹配零或多个该类的字符。这个条目总是匹配尽可能短的串
+|将匹配一或多个该类的字符。这个条目总是匹配尽可能长的串
?|将匹配零或一个该类的字符。它会匹配一个
^|将使匹配过程锚定到字符串的开始
$|将使匹配过程锚定到字符串的结尾
()|捕获匹配，%n等于n号捕获物

## 六.Table

### Lua数组

```lua
--一维数组
arr1 = {'a','b','c','d'}
print("arr1[1]:"..arr1[1])  --arr1[1]:a
print("#arr1:"..#arr1)      --#arr1:4

--二维数组
arr2 = {{'a','b'},{'c','d'}}
print("arr2[1][1]:"..arr2[1][1]) --arr2[1][1]:a
print("#arr2:"..#arr2)           --#arr2:2
print("#arr2[1]:"..#arr2[1])     --#arr2[1]:2

--关联数组
arr3 = {a='A',b='B'}
print("arr3['a']:"..arr3['a'])   --arr3['a']:A
print("arr3.a:"..arr3.a)         --arr3.a:A
print("#arr3:"..#arr3)           --#arr3:0
```

### Lua迭代器

```lua
for key,value in ipairs(array)
do
    print(key,value)
end
```

#### Lua迭代器工作流程:

1).计算in后面表达式的值，表达式应该返回泛型for需要的三个值：迭代函数、状态常量、控制变量。<br>
2).将状态常量和控制变量作为参数调用迭代函数。<br>
3).将迭代函数返回的值赋给变量列表。<br>
4).如果返回的第一个值为nil循环结束，否则执行循环体。


>无状态迭代器:不保留任何状态的迭代器，只需要状态常量与控制变量即可

```lua
--可以看出当array中的中间有nil，则会中断后续遍历
function iter (a, i)
    i = i + 1
    local v = a[i]
    if v then
       return i, v
    end
end
 
function ipairs (a)
    return iter, a, 0
end

for key,value in ipairs(array)
do
    print(key,value)
end
```

>多状态的迭代器:需要保存多个状态信息而不是简单的状态常量和控制变量，通常使用匿名函数(闭包)

```lua
function elementIterator(collection)
   local index = 0
   local count = #collection
   --闭包函数
   return function ()
      index = index + 1
      if index <= count
      then
         --返回迭代器的当前元素
         return collection[index]
      end
   end
end

for element in elementIterator(array)
do
   print(element)
end
```

### Table操作

函数名|描述
--|--
table.concat(table[,sep[,start[,end]]])|将table中元素从start到end以sep分隔符隔开的字符串输出
table.insert(table,[pos,]value)|插入pos位置的元素(省略pos表示数组末尾)
table.remove(table[,pos])|删除pos位置的元素(省略pos表示数组末尾)
table.sort(table)|对table进行升序排序

## 七.Lua错误处理

### 常用函数

函数名|描述
--|--
assert(boolean,message)|当boolean为false时，输出message信息
error(message[,level])|触发错误，输出message(0:不额外添加错误信息，1[默认]:额外添加错误位置，2:额外添加详细错误信息)
pcall(function,args...)|执行函数并传参，若有错返回false，否则返回true
xpcall(fucntion,deal,args...)|执行函数并传参，若有错返回false并用deal函数处理，否则返回true

```lua
--待处理函数
function myfunction ()
    n = n/nil
end
--错误处理函数
function deal(err)
    print("ERROR:",err)
end

--ERROR:Hello.lua:3: attempt to perform arithmetic on a nil value (global 'n')
xpcall(myfunction,deal)
```