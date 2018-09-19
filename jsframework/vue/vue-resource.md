# Vue-resource

### (1).配置

```
#全局
Vue.http.options.root = '/root';
Vue.http.headers.common['Authorization'] = 'Basic YXBpOnBhc3N3b3Jk';

#局部
{
   http: {
      root: '/root',
      headers: {
        Authorization: 'Basic YXBpOnBhc3N3b3Jk'
      }
   }
}
```

<br>

### (2).HTTP

config|类型|描述
--|--|--
params|Object|请求的URL参数对象
headers|Object|请求头
responseType|string|返回类型(text, blob, json, ...)


response|类型|描述
--|--|--
body|Object, Blob, string|响应体
status|number|响应的HTTP状态码
statusText|string|响应的状态文本
text()|string|以string形式返回response body
json()|Object|以JSON对象形式返回response body
blob()|Blob|以二进制形式返回response body

```
#全局
Vue.http.get('/someUrl', [config]).then(successCallback, errorCallback);
Vue.http.post('/someUrl', [body], [config]).then(successCallback, errorCallback);
Vue.http.head('/someUrl', [config]).then(successCallback, errorCallback);
Vue.http.put('/someUrl', [body], [config]).then(successCallback, errorCallback);
Vue.http.delete('/someUrl', [config]).then(successCallback, errorCallback);

#局部
this.$http.get('/someUrl', [config]).then(successCallback, errorCallback);
this.$http.post('/someUrl', [body], [config]).then(successCallback, errorCallback);
this.$http.head('/someUrl', [config]).then(successCallback, errorCallback);
this.$http.put('/someUrl', [body], [config]).then(successCallback, errorCallback);
this.$http.delete('/someUrl', [config]).then(successCallback, errorCallback);
```

<br>

### (3).拦截器

```
Vue.http.interceptors.push(function(request) {
  // modify request
  request.method = 'POST';
  // return response callback
  return function(response) {
    // modify response
    response.body = '...';
  };
});
```

<br>

### (4).Restful

```
  var resource = this.$resource('someItem{/id}');

  // GET someItem/1
  resource.get({id: 1}).then(response => {
    this.item = response.body;
  });

  // POST someItem/1
  resource.save({id: 1}, {item: this.item}).then(response => {
    // success callback
  }, response => {
    // error callback
  });
  
  // PUT someItem/1
  resource.update({id: 1}, {item: this.item}).then(response => {
    // success callback
  }, response => {
    // error callback
  });
  
  // DELETE someItem/1
  resource.delete({id: 1}).then(response => {
    // success callback
  }, response => {
    // error callback
  });
```
