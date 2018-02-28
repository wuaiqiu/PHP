<?php
#分页


//1.控制器
#查询所有用户数据 并且每页显示3条数据
$list = User::paginate(3);
#把分页数据赋值给模板变量list
$this->assign('list', $list);
#渲染模板输出
return $this->fetch();


//2.视图
<div>
    <ul>
        <volist name='list' id='user'>
        <li> {$user.name}</li>
        </volist>
    </ul>
</div>
{$list->render()}