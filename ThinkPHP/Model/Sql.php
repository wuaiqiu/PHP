<?php
/*
 * 
 * (1)开启调试
 *  
 *      #开启页面Trace
 *      'SHOW_PAGE_TRACE'=>true 	
 * 
 *      #设置需要保存的选项卡：当前日期_trace.log
 *      'PAGE_TRACE_SAVE' => array('base','file','sql');
 * 
 * 
 * (2)连贯操作:连贯操作的方法调用顺序没有先后;
 *       a.【 where('条件数组') 】（支持多次调用）
 *          $con1['id']=array('gt',1);
 *          $con2['class']='103';
 *          $link->where($con1)->where($con2)->select();
 *          ==>	SELECT * FROM `users` WHERE `id` > 1 AND `class` = '103';
 *
 *       b.【 order(array('字段'=>'desc|esc')) 】
 *          $con['id']=array('gt',1);
 *          $link->where($con)->order(array('id'=>'desc'))->select();
 *          ==>	SELECT * FROM `users` WHERE `id` > 1 ORDER BY `id` desc;
 *
 *       c.【 field('字段') 】
 *          $link->field(array('id'=>'s','url'))->select();
 *          ==>	SELECT `id` AS `s`,`url` FROM `apps` ;
 *          
 *          $link->field(array('url'),true)->select();	#排除url字段
 *          ==> SELECT `id`,`app_name`,`country` FROM `apps`;
 *
 *       d.【 limit(n1[,n2]) 】
 *          $link->limit(1,2)->select();
 *          ==>	SELECT * FROM `users` LIMIT 1,2;
 *          
 *          $link->limit(2)->select();
 *          ==>SELECT * FROM `apps` LIMIT 2;
 *          
 *       e.【page(n1,n2)】
 *          $link->page(1,3)->select();
 *          ==>SELECT * FROM `apps` LIMIT 0,3
 *          
 *          $link->page(2,3)->select();
 *          ==>SELECT * FROM `apps` LIMIT 3,3
 *
 *       f.【 group('字段名') ,只有一个参数，并且只能使用字符串】
 *          $link->group('id')->select();
 *          ==>	SELECT * FROM `users` GROUP BY id;
 *
 *       g.【 having('查询条件')) ,只有一个参数，并且只能使用字符串】
 *          $con['id']=array('gt',1);
 *          $link->group('id')->having($con)->select();
 *          ==>	SELECT * FROM `users` GROUP BY id HAVING 'id'>1;
 *
 *       h.【 join('查询条件',INNER | LEFT | RIGHT | FULL)】
 *          $link->join('class ON user.id = class.id')->select();
 *          ==> SELECT * FROM 'user' INNER JION  class ON user.id=class.id;
 *
 *          $link->join('class ON user.id = class.id','LEFT')->select();
 *          ==> SELECT * FROM 'user' LEFT JION class ON user.id=class.id;
 *
 *       i.【 union('sql语句',flase | true) 】
 *          $link->field('name')->union('select name from students')->select();
 *          ==> SELECT name FROM user UNION SELECT  name FROM students;
 *
 *          $link->field('name')->union('select name from students',true)->select();
 *          ==> SELECT name FROM user UNION ALL SELECT  name FROM students;
 *
 *       j.【 distinct(true | false) ,参数是一个布尔值】
 *          $link->distinct(true)->field('name')->select();
 *          ==> SELECT DISTINCT name FROM user;
 *          
 *       k.【fetchSql(true,false),用于直接返回SQL而不是执行查询】
 *          $link->fetchSql(true)->select();
 *          ==>"SELECT * FROM `apps`";
 *
 *  (3)基本查询方式
 *        a.字符串查询,不安全
 *        $link->where('id=1 and class=103')->select();
 *        ==>	SELECT * FROM `users` WHERE ( id=1 and class=103 )
 *
 *        b.索引数组查询,推荐使用；$con[_logic]='or';改变逻辑
 *        $con['id']=1;
 *        $con['class']='103';
 *        $link->where($con)->select();
 *        ==>	SELECT * FROM `users` WHERE `id` = 1 AND `class` = '103'
 *
 *
 *  (4)表达式查询  【 $map['字段']=array('表达式','查询条件') 】
 *       eq	=		neq	!=		gt	>		    gte	>=
 *       lt	<		lte	<=		[not]like		[not] between
 *       [not] in  exists   all
 *
 *
 *  (5)快捷查询    【 字段|字段  字段&字段 】
 *       a.不同字段相同查询条件
 *       $map['id|class']=1;
 *       $link->where($con)->select();
 *       ==>	SELECT * FROM `users` WHERE ( `id` = 1 OR `class` = 1 );
 *
 *       b.不同字段不同查询条件,'_multi'字段指定 一 一 对应
 *       $con['id&class']=array(1,'103','_multi'=>true);
 *       $link->where($con)->select();
 *       ==>SELECT * FROM `users` WHERE ( (`id` = 1) AND (`class` = '103') );
 *
 *       c.支持表达式查询
 *       $con['id&class']=array(array('gt',1),'103','_multi'=>true);
 *       $link->where($con)->select();
 *       ==>	SELECT * FROM `users` WHERE ( (`id` > 1) AND (`class` = '103') );
 *
 *
 *  (6)区间查询  【 $map['字段']=array(array('表达式','查询条件'),array('表达式','查询条件'),'逻辑符') 】
 *       $con['id']=array(array('gt',1),array('lt',3),'or');
 *       $link->where($con)->select();
 *       ==>	SELECT * FROM `users` WHERE ( `id` > 1 OR `id` < 3 );
 *
 *
 *  (7)统计查询	【 count() ， max() ， min() ， avg() ， sum() 】
 *      $link->count();
 *      ==>	SELECT COUNT(*) AS tp_count FROM `users` LIMIT 1;
 *
 *      $link->count('id');
 *      ==>SELECT COUNT(id) AS tp_count FROM `users` LIMIT 1;
 *
 *
 *  (8)原生sql查询	【 query('sql语句')	execute('sql语句') 】
 *      a.query读取
 *      $link->query('select * from users')
 *      ==>	select * from users;
 *
 *      b.execute执行
 *      $link->execute("insert into users values(7,'li','104')")
 *      ==>	insert into users values(7,'li','104')
 *
 *  (9)参数绑定;预处理
 *      $wdata=array('id'=>array('gt',':id'),'country'=>':country');
 *      $bdata=array(':id'=>I('get.id'),':country'=>I('get.cou'));
 *      $link->where($wdata)->bind($bdata)->select();
 *      ==>SELECT * FROM `apps` WHERE `id` > '2' AND `country` = 'CN';
 *      
 *  (10)命名范围（将sql操作封装成Model）
 *    
 *  a.定义
 *  	 protected $_scope=array(
 *        'sql1'=>array('where'=>array('id'=>1)) ,
 *        'sql2'=>array('order'=>'id desc','limit'=>2)
 *        #默认的命名范围
 *        'default'=>array('where'=>array('status'=>1),'limit'=>10)
 *       );
 *       
 *    
 *  b.调用
 *      $link->scope('sql1')->select()：调用指定的sql操作
 *      $link->sql1()->select()：调用指定的sql操作
 *      $link->scope()->select()：调用默认sql操作
 *      $link->scope('sql1')->scope('sql2')->select():调用多个sql操作
 *      $Model->scope('normal,latest')->select():调用多个sql操作
 * 
 * */

?>