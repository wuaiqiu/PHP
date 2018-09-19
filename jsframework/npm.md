# npm

```
#初始化
npm init

#局部安装
npm install lodash
npm install lodash -–save-dev 

#局部更新
npm update

#局部卸载
npm uninstall lodash

#局部安装列表
npm list

#全局安装
npm install -g jshint

#全局更新
npm update -g

#全局卸载
npm uninstall -g jshint

#全局安装列表
npm list -g

#搜索模块
npm search express

#登录npm
npm adduser

#发布(1.不能和已有的包的名字重名;2.不能有大写字母/空格/下滑线;3..gitignore 或.npmignore可以忽略上传)
npm publish

#删除(1.只有在发包的24小时内才允许撤销发布的包;2即使你撤销了发布的包，发包的时候也不能再和被撤销的包的名称和版本重复了)
npm unpublish wuaiqiu1 --force

#更新发布,修改包的版本,在发布
npm version major|minor|patch

#查看npm脚本（node_modules/.bin子目录加入PATH变量）
npm run

#执行顺序
npm run script1.js & npm run script2.js #script1与script2并行
npm run script1.js && npm run script2.js    #先script1在script2

#钩子
npm run build
==>npm run prebuild && npm run build && npm run postbuild

#查看缓存目录
npm config get cache

#清空缓存目录
npm cache clean
```

```
{
  "name": "项目名",
  "version": "项目版本",
  "description": "项目描述",
  "main": "index.js",#出口文件
  "scripts": { #npm脚本
    "test": "rm -rf node_*"
  },
  "repository": {//npm库或者"private": true
    "type": "git",
    "url": "git+https://github.com/wuaiqiu/s.git"
  },
  "dependencies": {//项目依赖
    "jquery": "^3.3.1"
  },
  "devDependencies": {//开发依赖
    "less": "^2.7.3"
  }
}
```

```
package-lock.json


1.在package-lock.json同级目录下添加自定义npm-shrinkwrap.json文件，package-lock.json会失效。
2.更新模块
    (1)直接用@方法安装指定版本的npm包
    (2)将旧版本包先uninstall，然后再次安装
    (3)删除package-lock.json，然后再次安装
3.package-lock.json是npm5做的一个优化，加快了npm 下载的速度。条件就是将依赖的详细信息，包括版本，下载地址等
```