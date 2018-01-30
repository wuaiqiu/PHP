# webpack


**(1)打包普通js**

***Greeter.js***

```
module.exports = function() {
  var greet = document.createElement('div');
  greet.textContent = "Hi there and greetings!";
  return greet;
};
```

***main.js***

```
const greeter = require('./Greeter.js');
document.querySelector("#root").appendChild(greeter());
```

>webpack main.js bundle.js --watch

<br>

**(2)处理ES6**

npm install --save-dev babel-core babel-loader babel-preset-env

```
module.exports = {
    module: {
        rules: [
          {
            test: /\.js$/, //所处理文件的拓展名的正则表达式
            use: { //使用的处理loader
                loader: "babel-loader", //loader的名称
                options: {
                    presets: ["env"]
                }
            },
            exclude: /node_modules/, //手动屏蔽(include添加)处理的文件（夹）
          }
        ]
   }
}
```

<br>

**(3)打包CSS**

npm install --save-dev style-loader css-loader

```
module.exports = {
    module: {
        rules: [
                {
                    test: /\.css$/,
                    use: [
                       {
                        loader: "style-loader"
                        }, {
                        loader: "css-loader"
                        options: {
                            minimize: true //压缩css
                        }
                        }
                     ]
                }
        ]
    }
}
```

<br>

**(4)处理SASS**

npm install --save-dev style-loader css-loader sass-loader node-sass

```
module.exports = {
    module: {
        rules: [
                {
                    test: /\.scss$/,
                    use: [
                            {
                               loader: "style-loader"
                            },{
                               loader: "css-loader"
                            },{
                               loader: "sass-loader"
                             }
                    ]
                }
         ]
    }
}
```

<br>

**(5)插件**

***HtmlWebpackPlugin(生成模板)***

npm install html-webpack-plugin

```
const webpack = require('webpack');
const HtmlWebpackPlugin = require('html-webpack-plugin');

module.exports = {
    plugins: [
        new webpack.BannerPlugin('版权所有，翻版必究'), //内置插件；在bundle.js中加版权
        new HtmlWebpackPlugin({
            template: __dirname + "/app/index.tmpl.html", //new 一个这个插件的实例，并传入相关的参数
        })
    ]
};
```

***ExtractTextPlugin(分离css与js)***

npm install --save-dev extract-text-webpack-plugin

```
const webpack = require('webpack');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
     module: {
        rules: [
                {
                  test: /\.css$/,
                  use: ExtractTextPlugin.extract({
                    fallback: "style-loader",
                    use: [{
                        loader: "css-loader",
                    }],
                })
               },{
                  test: /\.scss$/,
                  use: ExtractTextPlugin.extract({
                    fallback: "style-loader",
                    use: [{
                        loader: "css-loader",
                    }, {
                        loader: "sass-loader"
                    }]
                })
              }
       ]
   },
   plugins: [
            new webpack.optimize.OccurrenceOrderPlugin(), //为组件分配ID
            new webpack.optimize.UglifyJsPlugin(), //压缩JS代码
            new ExtractTextPlugin("style.css") //分离CSS和JS文件
    ]
};
```

***clean-webpack-plugin(去除残余文件)***

```
const CleanWebpackPlugin = require("clean-webpack-plugin");

module.exports = {
    plugins: [
        new CleanWebpackPlugin('public/*.*', {
            root: __dirname,
            verbose: true,
            dry: false
        })
    ]
}
```

<br>

**(6)引入jquery及其插件**

```
output : {
    filename : "bundle-[hash].js,
    path : __dirname + "/public",
    libraryTarget : 'var'  
},

import $ from 'jquery'
import 'jquery-ui' 
```

<br>


**(7)配置文件**

```
module.exports = {
  entry:  __dirname + "/app/main.js",#唯一入口文件
  output: {
    path: __dirname + "/public", #打包后的文件存放的地方
    filename: "bundle-[hash].js"        #打包后输出文件的文件名
  },
   devtool: 'eval-source-map',#用于调试;cheap-module-eval-source-map推荐在大型项目使用
}
```