<?php
/*
 * 标签库
 *      标签库分为内置和扩展标签库，内置标签库是Cx标签库。内置标签库无需导入即可使用，并且不需要加
 * 标签库前缀
 *      #设置内置标签库
 *      'TAGLIB_BUILD_IN'    =>    'cx,article'
 *
 *  (1)加载标签库
 *      <taglib name="html,article" />
 *      或
 *      'TAGLIB_PRE_LOAD' => 'article,html'
 *
 *
 *  (2)内置标签（cx标签库）
 *        a.包含文件(如果修改了包含的外部模板文件后，需要把模块的缓存目录清空，否则无法生效。/Application/Runtime/Cache/Home)
 *   	  <include file="模块@主题/控制器/操作">
 *        <include file="User/head"/>
 *        <include file="User/foot"/>
 *
 *        #也可以使用绝对路径
 *        <include file="./Application/Home/View/default/User/head.html"/>
 *        
 *        #传参
 *        <include file="User/foot" name='zhfangna'/>
 *        
 *        
 *        b.if
 *          <if condition="($name eq 1) OR ($name gt 100)">
 *              value1
 *          <elseif condition="$name eq 2"/>
 *              value2
 *          <else />
 *              value3
 *          </if>
 *
 *              1).在condition属性中可以支持eq等判断表达式，同上面的比较标签，但是不支持带有”>”、”<”等符号的用法，因为会混淆模板解析
 *              2).condition中可以使用php函数
 *              3).condition中可以使用ThinkPHP系统变量
 *                  condition="$Think.get.name eq 'zhangsan'"
 *        
 *        
 *        c.switch（0表示不需要break，默认为1）
 *          <switch name="变量" >
 *              <case value="值1" break="0|1">输出内容1</case>
 *              <case value="值2">输出内容2</case>
 *              <default />输出内容3
 *          </switch>
 *
 *
 *        d.比较标签
 *          eq 或者 equal		等于
 *          neq 或者 notequal	不等于
 *          gt			        大于
 *          egt			        大于等于
 *          lt			        小于
 *          elt			        小于等于
 *          heq			        恒等于
 *          nheq			    不恒等于
 *
 *          #要求name变量的值等于value就输出
 *          <eq name="name" value="value">value</eq>
 *          #统一标签
 *          <compare name="name" value="5" type="eq">value</compare>
 *
 *
 *        e.范围标签
 *          in 或者 notin		     是否在某个范围
 *          between 或者 notbetween  是否在某个区间范围
 *
 *          <in name="id" value="1,2,3">
 *          			id在范围内
 *          <else/>
 *                      id不在范围内
 *          </in>
 *
 *          #统一标签
 *          <range name="id" value="1,2,3" type="in
 *                  输出内容1
 *          </range>
 *
 *        
 *        f.其他标签
 *          （1）	present/notpresent		判断某个变量是否已经定义
 *              <present name="name">
 *                  name已经赋值
 *              </present>
 *          （2）	empty/notempty			判断某个变量是否为空
 *              <empty name="name">
 *                   name为空值
 *              </empty>
 *          （3）	defined/notdefined		判断某个常量是否有定义
 *              <defined name="NAME">
 *                  NAME常量已经定
 *              </defined>
 *          （4）	assign				在模板文件中赋值变量
 *              <assign name="var" value="123" />
 *          （5）	define				用于中模板中定义常量
 *              <define name="PI" value="3.14" />
 *
 *        
 *        h.volist遍历
 *           name :assign传来的变量名
 *           id ：volist内部的别名(等同于name)
 *           offset：数组开始位置
 *           length：读取几条数据
 *           empty : 当数据为空时，显示的信息，接受变量
 *           mod：模2操作
 *           key：前序
 *
 *           <ul>
 *              <volist name="data" id="arr" key="k">
 *                  <li>{$k}--{$arr.name}---{$arr.id}----{$arr.class}</li>
 *              </volist>
 *           </ul>
 *
 *           #显示偶数行
 *           <ul>
 *              <volist name="data" id="arr" mod="2">
 *                  <eq name="mod" value="0">
 *                      <li>{$arr.name}---{$arr.id}----{$arr.class}</li>
 *                  </eq>
 *              </volist>
 *           </ul>
 *
 *           #前序支持{$i}，不能有key属性（从1开始，与属性key相同）但是直接使用{$key}(从0开始)
 *           <ul>
 *              <volist name="data" id="arr">
 *                  <li>{$i}----{$arr.name}---{$arr.id}----{$arr.class}</li>
 *              </volist>
 *           </ul>
 *
 *    
 *    i.foreach遍历
 *          name：表示数据源
 *          item：表示循环变量
 *          key：前序，它支持{$key}，不支持{$i}
 *
 *         <foreach name="list" item="vo">
 *              {$vo.id}:{$vo.name}
 *         </foreach>
 *
 * 
 *    j.for循环
 *          comparison：默认是小于(lt)
 *          step：步进值
 *
 *          <for start="开始值" end="结束值" name="循环变量名" >
 *          </for>
 *
 *   
 *    k.literal标签 	原样输出
 *
 *         <literal>
 *          <?php
 *              echo "helllo";
 *          ?>
 *         </literal>
 *
 * 
 *    l.导入标签
 *
 *          (1)import
 *               #表示/Public/Js/index.js
 *               <import type='js' file="Js.index" />
 *
 *               #表示/Public/Css/index.css
 *               <import type='css' file="Css.index" />
 *
 *               #表示 /day6/Application/Common/Common/index.css
 *               <import type='css' file="index"  basepath="/Application/Common/Common"/>
 *
 *          (2)load
 *              <load href="/Public/Js/Common.js" />
 *              <load href="/Public/Css/common.css" />
 *              <load href="/Application/Common/Common/index.css" />
 *
 * */