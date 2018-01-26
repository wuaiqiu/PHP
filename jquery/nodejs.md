# NodeJs

**(1).异步编程**

```
//异步读取文件
var fs = require("fs");
fs.readFile('input', function (err, data) {
    if (err) {
        console.error(err);
        return;
    }else{
        console.log(data.toString());
    }
});
console.log("程序执行结束!");


//同步读取文件
var fs = require("fs");
var data = fs.readFileSync('input');
console.log(data.toString());
console.log("程序执行结束!");
```

<br>

**(2).事件驱动**

```
var events = require('events');
var eventEmitter = new events.EventEmitter();

// 监听器 #1
var listener1 = function() {
   console.log('监听器 listener1 执行。');
}
// 监听器 #2
var listener2 = function() {
  console.log('监听器 listener2 执行。');
}

// 绑定 connection 事件，处理函数为 listener1 
eventEmitter.addListener('connection', listener1);
// 绑定 connection 事件，处理函数为 listener2
eventEmitter.on('connection', listener2);

//类方法;返回指定事件的监听器数量。
var count=events.EventEmitter.listenerCount(eventEmitter,'connection');
console.log(count + " 个监听器监听连接事件。");

// 触发 connection 事件 
eventEmitter.emit('connection');

// 移除监绑定的 listener1 函数
eventEmitter.removeListener('connection', listener1);
//移除指定事件监绑定的函数
eventEmitter.removeAllListeners('connection');
```

<br>

**(3).缓冲区**

```
// 创建一个长度为 10、且用 0 填充 encoding为utf8的 Buffer。
const buf1 = Buffer.alloc(10);

// 创建一个长度为 10、且用 0x1 填充 encoding为utf8的 Buffer。 
const buf2 = Buffer.alloc(10, 1);

// 创建一个长度为 10、且未初始化的 Buffer。这个方法比调用 Buffer.alloc() 更快，但返回的 Buffer 实例可能包含旧数据，因此需要使用 fill() 或 write() 重写。
const buf3 = Buffer.allocUnsafe(10);

// 创建一个包含 [0x1, 0x2, 0x3] 的 Buffer。传入的 array 的元素只能是数字，不然就会自动被 0 覆盖
const buf4 = Buffer.from([1, 2, 3]);

// 创建一个包含UTF-8编码的'test'的 Buffer。
const buf5 = Buffer.from('test');
```

```
//写入缓存，返回实际写入的大小；buf.write(string[, offset[, length]])
len = buffer.write("www.runoob.com");
console.log("写入字节数 : "+  len);
```

```
//读入缓存；解码缓冲区数据并使用指定的编码返回字符串。默认为utf8；buf.toString([encoding[, start[, end]]])
console.log(buffer.toString());
```

```
//将 Buffer 转换为 JSON 对象
console.log(buffer.toJSON());
//{ type: 'Buffer', data: [ 116, 101, 115, 116 ] }
```

```
//缓冲区合并
var buffer1 = Buffer.from('菜鸟教程');
var buffer2 = Buffer.from('www.runoob.com');
var buffer3 = Buffer.concat([buffer1,buffer2]);
console.log("buffer3 内容: " + buffer3.toString());
```

```
//拷贝缓冲区;buf.copy(targetBuffer[, targetStart[, sourceStart[, sourceEnd]]])
var buf1 = Buffer.from('abcdefghijkl');
var buf2 = Buffer.from('RUNOOB');
//将 buf2 插入到 buf1 指定位置上
buf2.copy(buf1, 2);
console.log(buf1.toString());
#abRUNOOBijkl
```

```
//缓冲区裁剪;buf.slice([start[, end]])
var buffer1 = Buffer.from('runoob');
// 剪切缓冲区
var buffer2 = buffer1.slice(0,2);
console.log("buffer2 content: " + buffer2.toString());
```

```
//缓冲区长度
buffer.length;
```

<br>

**(4).流**

```
//读取流
var fs = require("fs");
var data = '';

//创建可读流
var readerStream = fs.createReadStream('input');
//设置编码为 utf8。
readerStream.setEncoding('UTF8');

//处理流事件data:当有数据可读时触发。
readerStream.on('data', function(chunk) {
   data += chunk;
});

//处理流事件end:没有更多的数据可读时触发。
readerStream.on('end',function(){
   console.log(data);
});

//处理流事件error:在接收和写入过程中发生错误时触发。
readerStream.on('error', function(err){
   console.log(err.stack);
});
```

```
//写入流
var fs = require("fs");
var data = '菜鸟教程官网地址：www.runoob.com';

//创建一个可以写入的流，写入到文件 output中
var writerStream = fs.createWriteStream('output');
//使用 utf8 编码写入数据
writerStream.write(data,'UTF8');
//标记文件末尾
writerStream.end();

//处理流事件finish:所有数据已被写入到底层系统时触发
writerStream.on('finish', function() {
    console.log("写入完成。");
});

//处理流事件error:在接收和写入过程中发生错误时触发。
writerStream.on('error', function(err){
   console.log(err.stack);
});
```

```
//管道流
var fs = require("fs");
// 创建一个可读流
var readerStream = fs.createReadStream('input');
// 创建一个可写流
var writerStream = fs.createWriteStream('output');
// 管道读写操作
readerStream.pipe(writerStream);
```

```
//链式流,一般用于管道操作
var fs = require("fs");
var zlib = require('zlib');

// 压缩 input文件为 input.gz
fs.createReadStream('input')
  .pipe(zlib.createGzip())
  .pipe(fs.createWriteStream('input.gz'));

// 解压 input.gz 文件为 input
fs.createReadStream('input.gz')
  .pipe(zlib.createGunzip())
  .pipe(fs.createWriteStream('input'));
```

<br>

**(5).模块系统**

```
//单个函数导出
function fun(){
	console.log("fun");
} 
module.exports=fun;

//多个函数导出
module.exports={
	fun1:function(){
		console.log('fun1');
	},
	fun2:function(){
		console.log('fun2');
	}
}
```

```
//单个函数导入
var fun=require('demo');
fun();

//多个函数导入
var fun=require('demo');
fun.fun1();
fun['fun2']();
```

<br>

**(6).路由**

```
var http = require('http');
var url = require('url');
var querystring=require('querystring');
//创建服务器
http.createServer( function (request, response) {  
	if(request.url!='/favicon.ico'){
  		 //解析路径
   		  var pathname = url.parse(request.url).pathname;
   		 //输出
           console.log("pathname: " + pathname);
           //解析参数
           var query=url.parse(request.url).query;
           //输出
           console.log("query: " + query);
           //分解参数
           var a = querystring.parse(query)["a"]
           console.log("a: "+a);
   }
   //响应数据
   response.end();
}).listen(8888);
 
// 控制台会输出以下信息
console.log('Server running at http://127.0.0.1:8888/'); 
```

<br>

**(7).全局变量**

```
__filename ： 表示当前正在执行的脚本的文件绝对路径
__dirname ： 表示当前执行脚本所在的目录
```