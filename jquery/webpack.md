# webpack


**(1)打包普通js**

***Greeter.js***

```
module.exports.a = function() {
  var greet = document.createElement('div');
  greet.textContent = "Hi there and greetings!";
  return greet;
};
module.exports.b={
    a:'A',
    b:'B'
};
```

***main.js***

```
const greeter = require('./Greeter.js');
document.querySelector("#root").appendChild(greeter.a());
console.log(greeter.b.a);
```

>webpack main.js -o bundle.js --watch

<br>
 
**(2)配置文件(webpack.config.js)**

entry属性指定一个入口起点(或多个入口起点)。默认值为./src
    字符串(从一个文件解析依赖):entry: 'file.js'
    数组(从多个互不依赖文件解析依赖):entry: ['file1.js','file2.js']
    对象(从多个文件解析依赖生成多个output文件):entry: {file1:'file1.js',file2:'file2.js'}
    
output属性告诉webpack在哪里输出它所创建的bundles,以及如何命名这些文件,默认值为./dist
    filename用于输出文件的文件名。可以使用占位符[name][hash]来确保每个文件具有唯一的名称
    path用于目标输出目录的绝对路径
    publicPath适用于插件在生产环境中自动地更新文件内部的URL指向
    
module.rules属性让webpack能够去处理那些非JavaScript文件(webpack自身只理解JavaScript)
    test属性用于标识出应该被对应的loader进行转换的某个或某些文件
    use属性表示进行转换时,应该使用哪个loader
       
plugins属性可以使用从打包优化和压缩,一直到重新定义环境中的变量的插件

mode属性可以启用相应模式下的webpack内置的优化
    development:开发模式
    production:生产模式(默认)

```
module.exports = {
  mode:'development',#开发模式
  entry:  __dirname + "/app/main.js",#入口文件
  output: {
    path: __dirname + "/public", #打包后的文件存放的地方
    filename: "bundle-[hash].js" #打包后输出文件的文件名
  },
  devtool: 'eval-source-map',#用于调试;cheap-module-eval-source-map推荐在大型项目使用
}
```

<br>

**(3)处理ES6,React**

npm install --save-dev babel-core babel-loader babel-preset-env babel-preset-react

```
module.exports = {
    module: {
        rules: [
          {
            test: /\.js$/, //所处理文件的拓展名的正则表达式
            use: { //使用的处理loader
                loader: "babel-loader", //loader的名称
                options: {
                    presets: ["env","react"]
                }
            },
            exclude: /node_modules/, //手动屏蔽(include添加)处理的文件（夹）
          }
        ]
   }
}
```

<br>

**(4)打包CSS**

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

**(5)处理SASS**

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

**(6)插件**

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
