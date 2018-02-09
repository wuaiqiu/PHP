# react

**一.引入**

```
<script src="https://cdn.bootcss.com/react/15.4.2/react.min.js"></script>
<script src="https://cdn.bootcss.com/react/15.4.2/react-dom.min.js"></script>
<script src="https://cdn.bootcss.com/babel-standalone/6.22.1/babel.min.js"></script>

<div id="container"></div>

<script type="text/babel">
//React的最基本方法，用于将模板转换成HTML语言，渲染DOM，并插入指定的DOM节点
//参数列表:1.渲染内容(HTML形式,不用双引号)；2.需要插入的DOM节点；3.渲染后的回调

ReactDOM.render(
    <h1>Hello React</h1>,
    document.getElementById('container')
);
</script>
```

<br>

**二.组件**

```
//1.组件类以大写字母开始，驼峰命名
//2.使用React.createClass方法创建
//3.每个组件类都必须实现render方法
//4.组件类只能包含一个顶层标签

var HelloMessage=React.createClass({
    render:function () {
        return <h1>Hello React</h1>;
    }
});

ReactDOM.render(
    <HelloMessage />,
    document.getElementById('container')
);
```

<br>

**三.组件样式**

```
//React与HTML区别:
//1.HTML以 ; 结尾，React以 , 结尾
//2.React的key使用驼峰命名法，value值不需要带单位

<style>
.blue{background-color: blue;}
</style>

var green={
  backgroundColor:"green"
};
var HelloMessage=React.createClass({
    render:function () {
        return <div>
                  <h1 style={{backgroundColor:"red"}}>Red</h1>
                  <h1 style={green}>Green</h1>
                  <h1 className="blue">Blue</h1>
               </div>;
    }
});

ReactDOM.render(
    <HelloMessage />,
    document.getElementById('container')
);
```

<br>

**四.复合(组合)组件**

```
var Baidu=React.createClass({
   render:function () {
       return <span>百度</span>;
   }
});

var Link=React.createClass({
    render: function () {
        return <a href="https://www.baidu.com">www.baidu.com</a>;
    }
});

var BaiduLink=React.createClass({
    render:function () {
        return <div>
                    <Baidu />
                    <Link />
               </div>;
    } 
});

ReactDOM.render(<BaiduLink />,document.getElementById('container'));
```

<br>

**五.组件属性**

```
//1.porps是组件自身的属性，一般用于嵌套内外层组件，负责传递消息（通常由父层组件向子层组件），{}用于读取变量

var Baidu=React.createClass({
   render:function () {
       return <span>{this.props.webname}</span>;
   }
});

var Link=React.createClass({
    render: function () {
        return <a href={this.props.weblink}>{this.props.weblink}</a>;
    }
});

var BaiduLink=React.createClass({
    render:function () {
        return <div>
                    <Baidu webname={this.props.name}/>
                    <Link weblink={this.props.link}/>
               </div>;
    } 
});

ReactDOM.render(<BaiduLink name="百度" link="http://www.baidu.com"/>,document.getElementById('container'));


//2. ...this.props:表示将父组件的全部属性都复制给子组件

var Link = React.createClass({
   render:function () {
       return <a {...this.props}>{this.props.name}</a>;
   }
});

ReactDOM.render(<Link href="https://www.baidu.com" name="百度" />, document.getElementById("container"));


//3.this.props.children:复制父组件的所有子组件到子组件

var List = React.createClass({
   render:function () {
       return <ul>
                {React.Children.map(this.props.children,function (child) {
                    return <li>{child}</li>
                })}
              </ul>;
   }
});

ReactDOM.render(<List><a href="#">百度</a><a href="#">腾讯</a></List>,document.getElementById('container'));


//4. propTypes 用于验证组件属性是否符合要求

var Title = React.createClass({
    propTypes: {
        title: React.PropTypes.string.isRequired，
        optionalArray: React.PropTypes.array,
        optionalBool: React.PropTypes.bool,
        optionalFunc: React.PropTypes.func,
        optionalNumber: React.PropTypes.number,
        optionalObject: React.PropTypes.object,
        optionalString: React.PropTypes.string,
        optionalMessage: React.PropTypes.instanceOf(Message),
    },
    render:function () {
        return <h1>{this.props.title}</h1>;
    }
});

ReactDOM.render(<Title title="百度" />,document.getElementById('container'));


//5.getDefaultProps设置属性默认值

var Title = React.createClass({
   getDefaultProps:function () {
     return {title:"百度"};
   },
    render:function () {
        return <h1>{this.props.title}</h1>;
    }
});

ReactDOM.render(<Title />,document.getElementById('container'));
```

<br>

**六.事件处理**

```
var Button = React.createClass({
   handleClick:function () {
        alert('点击');
   },
    render:function () {
        return <button onClick={this.handleClick}>点击一下</button>;
    }
});

ReactDOM.render(<Button/>,document.getElementById('container'));
```

<br>

**七.组件状态**

```
//1.getInitialState为初始化状态值
//2.state为组件自身状态
//3.当state发生变化时，会重新调用组件的render方法

var Check = React.createClass({
    getInitialState:function(){
      return {
          isCheck:false
      };
    },
   handleChange:function (event) {
        this.setState({
            isCheck:!this.state.isCheck
        });
   },
    render:function () {
        var text=this.state.isCheck?"已选中":"未选中";
        return <div>
                    <input type="checkbox" onChange={this.handleChange}/>
                    {text}
               </div>;
    }
});

ReactDOM.render(<Check/>,document.getElementById('container'));
```

<br>

**八.生命周期**

```
//1.创建阶段 getDefaultProps
//2.实例化阶段 getInitialState --> componentWillMount(组件将要挂载) --> render --> componentDidMount(组件已经挂载)
//3.更新阶段 componentWillReceiveProps --> shouldComponentUpdate(返回false则后面三个函数不执行) --> componentWillUpdate --> render --> componentDidUpdate
//4.销毁阶段 componentWillUnmount(组件移除前)

var Demo = React.createClass({
    getDefaultProps:function () {
        console.log("1.getDefaultProps");
        return {};
    },

    getInitialState:function () {
        console.log("2.getInitialState");
        return null;
    },

    componentWillMount:function () {
        console.log("3.componentWillMount");
    },

    render:function () {
        console.log("4-d.render");
        return <h1>Hello React</h1>;
    },

    componentDidMount:function () {
        console.log("5.componentDidMount");
    },

    componentWillReceiveProps:function () {
        console.log("a.componentWillReceiveProps");
    },

    shouldComponentUpdate:function () {
        console.log("b.shouldComponentUpdate");
        return true;
    },

    componentWillUpdate:function () {
        console.log("c.componentWillUpdate");
    },

    componentDidUpdate:function () {
        console.log("e.componentDidUpdate");
    },

    componentWillUnmount:function () {
        console.log("6.componentWillUnmount");
    }
});
//创建
ReactDOM.render(<Demo />,document.getElementById("container"));
//更新
ReactDOM.render(<Demo />,document.getElementById("container"));
//移除
ReactDOM.unmountComponentAtNode(document.getElementById('container'));
```