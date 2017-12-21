# webpack


(1)**打包js**

```
demo1.js
document.write("It works");
```

>wepack demo1.js bundle.js

```
demo2.js
module.exports = "It works from demo2";

demo1.js
document.write(require('./demo2.js'));
```

>webpack demo1.js bundle.js

<br>

(2)**打包css**

```
style.css
body {
    background: yellow;
}

demo1.js
require("!style-loader!css-loader!./style.css");
document.write("Hello");
```

>webpack demo1.js bundle.js

<br>

(3).**配置文件**

```
module.exports = {
    entry: "./demo1.js",
    output: {
        path: __dirname,
        filename: "bundle.js"
    },
    module: {
        loaders: [
            { 
              test: /\.css$/,
              loader: "style-loader!css-loader" 
             }
        ]
    }
};
```