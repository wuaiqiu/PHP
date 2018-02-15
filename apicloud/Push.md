# Push

```
var push = api.require('push');

#加入群组（默认加入了all）
push.joinGroup({
    groupName: 'department'
}, function(ret, err){
     if( ret ){
        alert( JSON.stringify( ret) );
     }else{
        alert( JSON.stringify( err) );
     }
});

#移除群组
push.leaveGroup({
    groupName: 'department'
}, function(ret, err){
     if( ret ){
        alert( JSON.stringify( ret) );
     }else{
        alert( JSON.stringify( err) );
     }
});

#一次性退出所有通过joinGroup加入的群组
push.leaveAllGroup();
```