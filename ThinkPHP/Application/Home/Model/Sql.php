<?php 
/*
 * (1)连贯操作
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
 *          $link->field('name','class')->select();
 *          ==>	SELECT `name`,`class` FROM `users` ;
 *          
 *       d.【 limit(n1[,n2]) 】
 *          $link->limit(1,2)->select();
 *          ==>	SELECT * FROM `users` LIMIT 1,2;
 *     
 *       e.【 group('字段名') 】
 *          $link->group('id')->select();
 *          ==>	SELECT * FROM `users` GROUP BY id;
 *          
 *       f.【 having('查询条件')) 】
 *          $con['id']=array('gt',1);
 *          $link->group('id')->having($con)->select();
 *          ==>	SELECT * FROM `users` GROUP BY id HAVING 'id'>1;
 *     
 *       g.【 join('查询条件',INNER | LEFT | RIGHT | FULL)】
 *          $link->join('class ON user.id = class.id')->select();
 *          ==> SELECT * FROM 'user' INNER JION  class ON user.id=class.id;
 *           
 *          $link->join('class ON user.id = class.id','LEFT')->select();
 *          ==> SELECT * FROM 'user' LEFT JION class ON user.id=class.id;
 *                        
 *       h.【 union('sql语句',flase | true) 】
 *          $link->field('name')->union('select name from students')->select();
 *          ==> SELECT name FROM user UNION SELECT  name FROM students;
 *          
 *          $link->field('name')->union('select name from students',true)->select();
 *          ==> SELECT name FROM user UNION ALL SELECT  name FROM students;
 *       
 *       i.【 distinct(true | false) 】
 *          $link->distinct(true)->field('name')->select();
 *          ==> SELECT DISTINCT name FROM user;
 *          
 *          
 *  (2)基本查询方式
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
 *  (3)表达式查询  【 $map['字段']=array('表达式','查询条件') 】
 *       eq	=		neq	!=		gt	>		    egt	>=
 *       lt	<		elt	<=		[not]like		[not] between
 *       [not] in
 *      
 *   
 *  (4)快捷查询    【 字段|字段  字段&字段 】
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
 *  (5)区间查询  【 $map['字段']=array(array('表达式','查询条件'),array('表达式','查询条件'),'逻辑符') 】
 *       $con['id']=array(array('gt',1),array('lt',3),'or');
 *       $link->where($con)->select();
 *       ==>	SELECT * FROM `users` WHERE ( `id` > 1 OR `id` < 3 );
 *     
 *       
 *  (6)统计查询	【 count() ， max() ， min() ， avg() ， sum() 】
 *      $link->count();
 *      ==>	SELECT COUNT(*) AS tp_count FROM `users` LIMIT 1;
 *      
 *      $link->count('id');
 *      ==>SELECT COUNT(id) AS tp_count FROM `users` LIMIT 1;
 *     
 *      
 *  (7)原生sql查询	【 query('sql语句')	execute('sql语句') 】
 *      a.query读取
 *      $link->query('select * from users')
 *      ==>	select * from users;
 *      
 *      b.execute执行
 *      $link->execute("insert into users values(7,'li','104')")
 *      ==>	insert into users values(7,'li','104')
 *      
 * */

?>