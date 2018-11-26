# Lua基础语法II


## 一.Lua元表(metetable)

### 常用函数

函数名|描述
--|--
setmetatable(table,metatable)|对指定table设置元表，成功时返回值为table，否则为false
getmetatable(table)|返回对象的元表

### __index元方法

>当你通过键来访问table的时候，如果键不存在，那么Lua就会调用metatable的__index元方法

```lua
--当__index为Table时
meta = { foo = 3 }
mytable = {}
setmetatable(mytable, { __index = meta })
print(mytable.foo)  -- 3
print(mytable.bar)  -- nil


--当__index为Function时
mytable = {}
setmetatable(mytable,{
    __index = function(mytable,key)
        if key == "foo" then
            return "3"
        else
            return nil
        end
    end
})
print(mytable.foo) -- 3
print(mytable.bar) -- nil
```

### __newindex元方法

>当你给表的一个缺少的索引赋值，解释器就会查找__newindex元方法，如果存在则调用这个方法而不进行赋值操作

```lua
meta = {}
mytable = {key1 = "value1"}
setmetatable(mytable, { __newindex = meta })

mytable.key2 = "value2"
print(mytable.key2) -- nil
print(meta.key2)    -- "value2"

mytable.key1 = "value3"
print(mytable.key1) -- value3
print(meta.key1)    -- nil
```

### __call元方法

>在Lua调用另一个table作为参数时调用时，Lua解释器会调用__call元方法

```lua
--实现两表元素之和
mytable = {10,20,30}
setmetatable( mytable , {
    __call = function(mytable, newtable)
        local sum = 0
        for i = 1, #mytable do
            sum = sum + mytable[i]
        end
        for i = 1, #newtable do
            sum = sum + newtable[i]
        end
        return sum
    end
})
newtable = {10,20,30}
print(mytable(newtable)) -- 120
```

### __tostring元方法

>用于修改表的输出行为

```lua
--输出表元素之和
mytable = { 10, 20, 30 }
setmetatable( mytable , {
    __tostring = function(mytable)
        local sum = 0
        for k, v in ipairs(mytable) do
            sum = sum + v
        end
        return "表所有元素的和为:"..sum
    end
})
print(mytable) -- 表所有元素的和为:60
```

### __add元方法

>两表元素相加

```lua
--两表相加操作
mytable = {1, 2, 3}
setmetatable(mytable, {
    __add = function(mytable, newtable)
        for i = 1,#mytable do
            mytable[i]=mytable[i]+newtable[i]
        end
        return mytable
    end
})

secondtable = {4,5,6}
mytable = mytable + secondtable
print(mytable[1],mytable[2],mytable[3]) -- 5 7 9
```

算术操作元方法|描述
--|--
__add|对应的运算符'+'
__sub|对应的运算符'-'
__mul|对应的运算符'*'
__div|对应的运算符'/'
__mod|对应的运算符'%'
__unm|对应的运算符'-'
__concat|对应的运算符'..'
__eq|对应的运算符'=='
__lt|对应的运算符'<'
__le|对应的运算符'<='

## 二.Lua模块

>类似于一个封装库,把一些公用的代码放在一个文件里，以API接口的形式在其他地方调用，有利于代码的重用和降低代码耦合度。Lua模块由变量、函数等已知元素组成的table

```lua
--[[
-- module.lua文件
-- ]]

--定义一个名为mod的模块
mod = {}
--定义一个常量
mod.constant = "这是一个常量"
--定义一个私有函数
local function fun()
    print("这是一个函数")
end
--定义一个公开函数
function mod.func()
    fun()
end
--导出mod模块
return mod
```

<br>

```lua
--[[
-- main.lua文件
-- ]]

--加载module文件，默认导入mod对象
require("module")
print(mod.constant)     -- 这是一个常量
mod.func()              -- 这是一个函数

--加载module文件，将mod对象取别名为m对象
local m = require("module")
print(m.constant)       -- 这是一个常量
m.func()                -- 这是一个函数
```

### 模块加载机制

```
1.从全局变量package.path中的路径中寻找，使用package.loadfile来加载模块
/usr/share/lua/5.3/?.lua
/usr/share/lua/5.3/?/init.lua
/usr/lib/lua/5.3/?.lua
/usr/lib/lua/5.3/?/init.lua
./?.lua
./?/init.lua

2.从全局变量package.cpath中的路径中寻找，使用package.loadlib来加载C程序库
/usr/lib/lua/5.3/?.so
/usr/lib/lua/5.3/loadall.so
./?.so
```

## 三.Lua协程

### 常用函数

函数名|描述
--|--
coroutine.create(function)|创建coroutine，返回coroutine
coroutine.resume(cor,args)|唤醒coroutine，传入function参数或将yield改变为此参数，返回boolean值
coroutine.yield([args...])|挂起coroutine，返回给resume的args
coroutine.status(cor)|查看coroutine的状态(dead，suspend，running)
coroutine.wrap(function)|创建coroutine，返回一个匿名函数，可以不通过resume直接调用唤醒coroutine
coroutine.running()|返回正在跑的coroutine号(线程号)

```lua
function foo (a)
    print("foo函数输出", a)
    return coroutine.yield(2 * a)
end

co = coroutine.create(function (a , b)
    print("第一次协程执行输出", a, b)
    local r = foo(a + 1)

    print("第二次协程执行输出", r)
    local r, s = coroutine.yield(a + b, a - b)

    print("第三次协程执行输出", r, s)
    return b, "结束协程"
end)

--[[
--  第一次协程执行输出 1 10
--  foo函数输出 2
--  main true 4
-- ]]
print("main", coroutine.resume(co, 1, 10))
--[[
--  第二次协程执行输出 r
--  main true 11 -9
-- ]]
print("main", coroutine.resume(co, "r"))
--[[
--  第三次协程执行输出 x y
--  main true 10 结束协程
-- ]]
print("main", coroutine.resume(co, "x", "y"))
--[[
--  main dead
-- ]]
print("main", coroutine.status(co))
```

## 四.Lua面向对象

### Table定义函数区别

```lua
--点号定义和点号调用
girl = {money = 200}
function girl.goToMarket(girl ,someMoney)
    girl.money = girl.money - someMoney
end
girl.goToMarket(girl ,100)
print(girl.money) -- 100

--冒号定义和冒号调用
boy = {money = 200}
function boy:goToMarket(someMoney)
    self.money = self.money - someMoney
end
boy:goToMarket(100)
print(boy.money) -- 100

--点号定义冒号调用或冒号定义点号调用
boy = {money = 200}
function boy.goToMarket(self ,someMoney)
    self.money = self.money - someMoney
end
boy:goToMarket(100)
print(boy.money) -- 100
```

>总结:冒号定义与冒号调用只是把第一个隐藏参数省略了，而该参数self指向调用者自身

### Lua类

```lua
-- 成员属性
Rectangle = {area = 0, length = 0, breadth = 0}
-- 构造方法 new
function Rectangle:new (o,length,breadth)
    local o = o or {}
    setmetatable(o, self)
    self.__index = self
    self.length = length or 0
    self.breadth = breadth or 0
    self.area = length*breadth;
    return o
end
-- 成员方法 printArea
function Rectangle:printArea ()
    print("矩形面积为 ",self.area)
end

-- 创建对象
obj = Rectangle:new(nil,10,20)
-- 访问属性
print(obj.length) -- 10
-- 访问成员函数
obj:printArea()   -- 矩形面积为 200
```

### Lua继承

```lua
-- 创建父类对象，初始化子类
Square = Rectangle:new()
-- 子类构造方法 new
function Square:new(o,length,breadth)
    local o = o or Rectangle:new (o,length,breadth)
    setmetatable(o, self)
    self.__index = self
    return o
end
-- 重写父类成员方法 printArea
function Rectangle:printArea ()
    print("正方形面积为 ",self.area)
end

-- 创建子类对象
sub = Square:new(nil,10,20)
-- 访问子类属性
print(sub.length) -- 10
-- 访问子类成员函数
sub:printArea()   -- 正方形面积为 200
```

## 五.Lua文件I/O

### 简单模式

>拥有一个当前输入文件和一个当前输出文件，并且提供针对这些文件相关的操作

```lua
-- 以只读方式打开文件
file = io.open("a.txt", "r")
-- 设置默认输入文件
io.input(file)
-- 输出文件第一行
print(io.read())
-- 关闭打开的文件
io.close(file)
-- 以附加的方式打开只写文件
file = io.open("a.txt", "a")
-- 设置默认输出文件
io.output(file)
-- 在文件最后一行添加
io.write("Hi Lua")
-- 向文件写入缓冲中的所有数据
io.flush()
-- 关闭打开的文件
io.close(file)
```

### 完全模式

>使用外部的文件句柄来实现。它以一种面对对象的形式，将所有的文件操作定义为文件句柄的方法

```lua
-- 以只读方式打开文件
file = io.open("a.txt", "r")
-- 输出文件第一行
print(file:read())
-- 关闭打开的文件
file:close()
-- 以附加的方式打开只写文件
file = io.open("a.txt", "a")
-- 在文件最后一行添加 Lua 注释
file:write("Hi Lua")
-- 向文件写入缓冲中的所有数据
file:flush()
-- 关闭打开的文件
file:close()
```

open模式|描述
--|--
r|只读方式，该文件必须存在
w|只写方式
a|附加方式
r+|可读写方式，该文件必须存在
w+|可读写方式
a+|可读写附加方式
b|二进制模式
+|号表示对文件既可以读也可以写

## 六.Lua数据库访问

### 安装驱动 

```
luarocks install luasql-mysql
```

### 操作数据库

```lua
require "luasql.mysql"

--创建环境对象
env = luasql.mysql()
--连接数据库
conn = env:connect("数据库名","用户名","密码","IP地址",端口)
--设置数据库的编码格式
conn:execute("SET NAMES UTF8")
--执行数据库操作
cur = conn:execute("select * from role")
--获取结果集
row = cur:fetch({},"a")
--解析结果集
while row do
    print(string.format("%d %s\n", row.id, row.name))
    row = cur:fetch(row,"a")
end
--关闭数据库连接
conn:close()
--关闭数据库环境
env:close()   
```