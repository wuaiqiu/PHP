# DB

**一.model对象**

```
var model = api.require('model');
model.config({
    appKey: 'F903E80D-406A-DE15-42B6-AD6B27BB774E',
    host: 'https://d.apicloud.com'
});

#插入数据
model.insert({
     class: 'demo',
     value: {
            name: 'wu123'
     }
}, function(ret, err){
    if( ret ){
        alert( JSON.stringify( ret ) );
    }else{
        alert( JSON.stringify( err ) );
    }
});

#删除数据
model.deleteById({
    class: 'demo',
    id: '5a83df140f7df71b4a1f8124'
}, function(ret, err){
    if( ret ){
      alert( JSON.stringify( ret ) );
    }else{
       alert( JSON.stringify( err ) );
    }
});

#更新数据
model.updateById({
  class: 'demo',
  id: '5a83df293adb65b5105f19ce',
  value: {
      name: 'Tom'
  }
}, function(ret, err){
  if( ret ){
       alert( JSON.stringify( ret ) );
  }else{
       alert( JSON.stringify( err ) );
  }
});

#查找数据
model.findById({
    class: 'demo',
    id: '5a83df293adb65b5105f19ce'
    }, function(ret, err){
    if( ret ){
         alert( JSON.stringify( ret ) );
    }else{
         alert( JSON.stringify( err ) );
    }
});

#查找所有符合条件的数据
model.findAll({
    class: "demo",
    qid: queryId
}, function( ret, err ) {
    if( ret ){
         alert( JSON.stringify( ret ) );
    }else{
         alert( JSON.stringify( err ) );
    }
});

#满足该条件的总记录数
model.count({
    class: "demo",
    qid: queryId
}, function( ret, err ) {
    if( ret ){
         alert( JSON.stringify( ret ) );
    }else{
         alert( JSON.stringify( err ) );
    }
});

#上传文件
model.uploadFile({
     report: false,
     data: {
       file: {
          name: 'a.txt',
          url: 'fs://a/a.txt'
        }
     }
    }, function(ret, err){
    if( ret ){
       alert( JSON.stringify( ret ) );
    }else{
       alert( JSON.stringify( err ) );
    }
});

#下载文件
model.downloadFile({
    report: true,
    id: '5a83e6230f7df71b4a1f8157',
    savePath: 'fs://a.txt'
  }, function(ret, err) {
    if( ret ){
         alert( JSON.stringify( ret ) );
    }else{
         alert( JSON.stringify( err ) );
    }
});
``` 

<br>

**二.query对象**

```
var query = api.require('query');
var queryId=query.createQuery(function( ret, err ){
   if( ret ){
       return ret.qid;
    }else{
       alert( JSON.stringify( err ) );
    }
});

#设置查询返回结果限制为n条
query.limit({
      qid: queryId,
      value: 3
});

#设置查询返回结果中忽略前n条
query.skip({
    qid: queryId,
    value: 0
});

#设置查询返回结果按某列正序排列
query.asc({
    qid: queryId,
    column: 'id'
});

#设置查询返回结果按某列倒序排列
query.desc({
    qid: queryId,
    column: 'id'
});

#设置查询条件为某列等于某值
query.whereEqual({
    qid: queryId,
    column: 'id',
    value: 'A00000000001'
});

#设置查询条件为某列内容中包含某值
query.whereLike({
    qid: queryId,
    column: 'name',
    value: 'wu'
});

#设置查询条件为某列的内容大于某值
query.whereGreaterThan({
    qid: queryId,
    column: 'id',
    value: 'A00000000001'
});

#设置查询条件为某列的内容大于等于某值
query.whereGreaterThanOrEqual({
    qid: queryId,
    column: 'id',
    value: 'A00000000001'
});

#设置查询条件为某列的内容小于某值
query.whereLessThan({
    qid: queryId,
    column: 'id',
    value: 'A00000000001'
});

#设置查询条件为某列的内容小于等于某值
query.whereLessThanOrEqual({
    qid: queryId,
    column: 'id',
    value: 'A00000000001'
});

#设置查询仅返回需要的字段
query.justFields({
    qid: queryId,
    value: ['value']
});
```

<br>

**三.relation对象**

```
var relation = api.require('relation');

#插入
relation.insert({
      class: 'demo2',
      id: '5a83ed577b5dc7794d63c229',
      column: 'rel',
      value: {
          name: 'wu111'
      }
}, function(ret, err){
       if( ret ){
          alert( JSON.stringify( ret) );
       }else{
          alert( JSON.stringify( err) );
       }
});

#数目
relation.count({
      class: 'demo2',
      id: '5a83ed577b5dc7794d63c229',
      column: 'rel'
}, function(ret, err){
       if( ret ){
          alert( JSON.stringify( ret) );
       }else{
          alert( JSON.stringify( err) );
       }
});

#获取所有
relation.findAll({
  class: 'demo2',
  id: '5a83ed577b5dc7794d63c229',
  column: 'rel'
}, function (ret, err) {
  if( ret ){
      alert( JSON.stringify( ret) );
  }else{
      alert( JSON.stringify( err) );
  }
});

#删除所有
relation.deleteAll({
    class: 'demo2',
    id: '5a83ed577b5dc7794d63c229',
    column: 'rel'
}, function(ret, err){
     if( ret ){
        alert( JSON.stringify( ret) );
     }else{
        alert( JSON.stringify( err) );
     }
});
```

<br>

**四.user对象**

```
var user = api.require('user');

#注册
user.register({
      username: 'wu123',
      password: '123456',
      email: 'xixi@apicloud.com'
 }, function( ret, err ) {
      if( ret ){
          alert( JSON.stringify( ret) );
      }else{
          alert( JSON.stringify( err) );
      }
});

#登录
user.login({
      username: 'wu123',
      password: '123456'
}, function( ret, err ) {
      if( ret ){
          alert( JSON.stringify( ret) );
       }else{
          alert( JSON.stringify( err) );
       }
});

#修改密码
user.updatePassword({
      password: '123456'
}, function(ret, err) {
      if( ret ){
          alert( JSON.stringify( ret) );
      }else{
          alert( JSON.stringify( err) );
      }
});

#注销
user.logout()
```