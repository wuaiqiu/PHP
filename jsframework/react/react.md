# react

**一.引入**

```
npm install react react-dom --save-dev

<div id="container"></div>


//React的最基本方法，用于将模板转换成HTML语言，渲染DOM，并插入指定的DOM节点
//参数列表:1.渲染内容(HTML形式,不用双引号)；2.需要插入的DOM节点；3.渲染后的回调
import React from 'react';
import ReactDOM from 'react-dom';

ReactDOM.render(
    <h1>Hello React</h1>,
    document.getElementById('container')
);

```

<br>

**二.组件**

```
//1.组件类以大写字母开始，驼峰命名
//2.每个组件类都必须实现render方法
//3.组件类只能包含一个顶层标签

class HelloMessage extends React.Component {
    render() {
        return  <h1>Hello React</h1>;
    }
}

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

class HelloMessage extends  React.Component{
    render() {
        return <div>
                <h1 style={{backgroundColor:"red"}}>Red</h1>
                <h1 style={green}>Green</h1>
                <h1 className="blue">Blue</h1>
            </div>;
    }
}

ReactDOM.render(
    <HelloMessage />,
    document.getElementById('container')
);
```

<br>

**四.复合(组合)组件**

```
class Baidu extends React.Component{
    render(){
        return <span>百度</span>;
    }
}

class Link extends React.Component{
    render(){
        return  <a href="https://www.baidu.com">www.baidu.com</a>;
    }
}

class BaiduLink extends React.Component{
    render(){
        return <div>
                    <Baidu />
                    <Link />
                </div>;
    }
}

ReactDOM.render(<BaiduLink />,document.getElementById('container'));
```

<br>

**五.组件属性**

```
//1.porps是组件自身的属性，一般用于嵌套内外层组件，负责传递消息（通常由父层组件向子层组件），{}用于读取变量

class Baidu extends React.Component{
    render(){
        return <span>{this.props.webname}</span>;
    }
}

class Link extends React.Component{
    render(){
        return  <a href={this.props.weblink}>{this.props.weblink}</a>;
    }
}

class BaiduLink extends React.Component{
    render(){
        return <div>
                    <Baidu webname={this.props.name}/>
                    <Link  weblink={this.props.link}/>
                </div>;
    }
}

ReactDOM.render(<BaiduLink name="百度" link="http://www.baidu.com"/>,document.getElementById('container'));


//2. ...this.props:表示将父组件的全部属性都复制给子组件

class Link extends React.Component{
   render() {
       return <a {...this.props}>{this.props.name}</a>;
   }
}

ReactDOM.render(<Link href="https://www.baidu.com" name="百度" />, document.getElementById("container"));


//3.this.props.children:复制父组件的所有子组件到子组件

class List extends React.Component{
   render() {
       return <ul>
                {React.Children.map(this.props.children,function (child) {
                    return <li>{child}</li>
                })}
              </ul>;
   }
}

ReactDOM.render(<List><a href="#">百度</a><a href="#">腾讯</a></List>,document.getElementById('container'));


//4. propTypes 用于验证组件属性是否符合要求

import PropTypes from 'prop-types';

class Title extends React.Component{
    render() {
        return <h1>{this.props.title}</h1>;
    }
}
Title.propTypes={
    title: PropTypes.string.isRequired,
    optionalArray: PropTypes.array,
    optionalBool: PropTypes.bool,
    optionalFunc: PropTypes.func,
    optionalNumber: PropTypes.number,
    optionalObject: PropTypes.object,
    optionalString: PropTypes.string,
    optionalMessage:PropTypes.instanceOf(Message),
};

ReactDOM.render(<Title title="百度" />,document.getElementById('container'));


//5.getDefaultProps设置属性默认值

class Title extends React.Component{
    render() {
        return <h1>{this.props.title}</h1>;
    }
}

Title.defaultProps = {
    title: '百度'
};

ReactDOM.render(<Title />,document.getElementById('container'));
```

<br>

**六.事件处理**

```
class Button extends React.Component{
    handleClick() {
        alert('点击');
    }
    render () {
        return <button onClick={this.handleClick}>点击一下</button>;
    }
}

ReactDOM.render(
    <Button/>,
    document.getElementById("root")
);
```

<br>

**七.组件状态**

```
//1.constructor为初始化状态值
//2.state为组件自身状态
//3.当state发生变化时，会重新调用组件的render方法

class Check extends React.Component{
    constructor(){
        super();
        this.state={
            isCheck:false
        };
        this.handleChange = this.handleChange.bind(this);
    }
    handleChange(event) {
        this.setState({
            isCheck:!this.state.isCheck
        });
    }
    render() {
        var text=this.state.isCheck?"已选中":"未选中";
        return <div>
            <input type="checkbox" onChange={this.handleChange}/>
            {text}
        </div>;
    }
}
ReactDOM.render(<Check/>,document.getElementById('container'));
```

<br>

**八.生命周期**

```
//1.实例化阶段  componentWillMount(组件将要挂载) --> render --> componentDidMount(组件已经挂载)
//2.更新阶段 componentWillReceiveProps --> shouldComponentUpdate(返回false则后面三个函数不执行) --> componentWillUpdate --> render --> componentDidUpdate
//3.销毁阶段 componentWillUnmount(组件移除前)

class Demo extends React.Component{
    //该方法在首次渲染之前调用，也是再render方法调用之前修改state的最后一次机会
    componentWillMount() {
        console.log("1.componentWillMount");
    }
    //该方法会创建一个虚拟DOM，用来表示组件的输出
    render(){
        console.log("2-d.render");
        return <h1>Hello React</h1>;
    }
    //已经渲染出真实的DOM后调用
    componentDidMount() {
        console.log("3.componentDidMount");
    }
    //在组件接收到一个新的prop(更新后)时被调用
    componentWillReceiveProps() {
        console.log("a.componentWillReceiveProps");
    }
    //返回一个布尔值,确定组件的props或者state的改变需不需要重新渲染
    shouldComponentUpdate() {
        console.log("b.shouldComponentUpdate");
        return true;
    }
    //在组件接收到了新的props或者state即将进行重新渲染前
    componentWillUpdate() {
        console.log("c.componentWillUpdate");
    }
    //在组件重新被渲染之后
    componentDidUpdate() {
        console.log("e.componentDidUpdate");
    }
    //在组件从DOM中移除的时候立刻被调用
    componentWillUnmount() {
        console.log("6.componentWillUnmount");
    }
}
//创建
ReactDOM.render(<Demo />,document.getElementById("container"));
//更新
ReactDOM.render(<Demo />,document.getElementById("container"));
//移除
ReactDOM.unmountComponentAtNode(document.getElementById('container'));
```