/*
* 双向数据绑定
* */

//构建虚拟DOM树
function node2Fragment(node,vm){
    var flag=document.createDocumentFragment(); //构建空树
    var child; //子节点
    while(child=node.firstChild){
        compile(child,vm); //开始解析每个结点
        flag.appendChild(child)//会自动删除node对象的child结点
    }
    return flag;
}

//解析节点
function compile(node,vm){
    //节点类型为元素
    if(node.nodeType===1){
        var attr=node.attributes;
        for(var i=0;i<attr.length;i++){
            if(attr[i].nodeName=='v-model'){//匹配v-model这个属性名称
                var name=attr[i].nodeValue;
                //添加input事件，当修改data属性，触发该属性的set函数
                node.addEventListener('input',function(e){
                    vm[name]=e.target.value;
                });
                node.value=vm[name];//将data的值赋给该node
            }
        }
    }
    //节点类型为text
    var reg=/\{\{(.*)\}\}/;
    if(node.nodeType===3){
        if(reg.test(node.nodeValue)){
            var name=RegExp.$1;//取出第一个匹配
            name=name.trim();
            node.nodeValue=vm[name];//将data的值赋给该node
            //初始化数据，并给对应的data属性值添加Watcher
            new Watcher(vm,node,name);
        }
    }
}

//对obj对象的key属性改变或获取触发
function defineReactive(obj,key,val){
    var dep=new Dep(); //定义一个订阅列队
    Object.defineProperty(obj,key,{
        get:function(){
            if(Dep.target)dep.addSub(Dep.target); //在第一次初始化时，添加订阅者watcher到主题对象Dep
            return val;
        },
        set:function(newVal){
            if(newVal===val)return ;
            val=newVal;
            dep.notify();//作为发布者发出通知（更新所有订阅了这个属性的view）
        }
    })
}

//观察对象obj所有的key交给vm对象来观察
function observe(obj,vm){
    Object.keys(obj).forEach(function(key){
        defineReactive(vm,key,obj[key])
    })
}

//Watcher对象，这个对象的作用就是初始化数据，以及触发get函数
function Watcher(vm,node,name){
    Dep.target=this; //Dep.target是一个Dep的静态属性,表示当前观察者。
    this.name=name;
    this.node=node;
    this.vm=vm;
    this.update();//订阅者执行一次更新视图
    Dep.target=null;
}

Watcher.prototype={
    update:function(){
        this.get();//触发对应data属性值的get函数
        this.node.nodeValue=this.value;
    },
    get:function(){
        this.value=this.vm[this.name]
    }
};

//订阅队列
function Dep(){
    this.subs=[]; //订阅者们
}

Dep.prototype={
    //添加订阅者的方法
    addSub:function(sub){
        this.subs.push(sub);
    },
    //发布信息的方法（让订阅者们全部更新view）
    notify:function(){
        this.subs.forEach(function(sub){
            sub.update();
        })
    }
};


//Vue构造函数
function Vue(options){
    this.data=options.data;
    var id=options.el;
    //将data的属性全部通过访问器属性赋给vm对象
    observe(this.data,this);
    var dom=node2Fragment(document.getElementById(id),this);
    //编译完成后，将dom片段添加到el挂载的元素上(app)
    document.getElementById(id).appendChild(dom)
}