<?php
/*关联模型（需要继承RelationModel）
 *  
 * 
 *(1). 一对一
 *
 *  a.HAS_ONE
 *     
 *     #UserModel类
 *     protected $_link=array(
 *          'Card'=>array(
 *            'mapping_type'=>self::HAS_ONE,
 *            'foreign_key'=>'uid', #关联表的键（与本主键关联）
 *            'mapping_name'=>'Card',#关联表名的映射
 *            'mapping_fields'=>'code',#要查询关联表的字段
 *            'as_fields'=>'code',#关联字段的映射
 *          )
 *     );
 *    
 *    b.BELONGS_TO
 *    
 *      #CardModel类
 *      protected $_link=array(
 *          'User'=>array(
 *            'mapping_type'=>self::BELONGS_TO,
 *            'foreign_key'=>'uid', #本表的键（关联表的主键）
 *            'mapping_name'=>'User',#关联表名的映射
 *            'as_fields'=>'user',#关联字段的映射
 *          )
 *     );
 *     
 *         
 *(2).一对多
 *
 *    a.HAS_MANY
 *    
 *       #UserModel类
 *       protected $_link=array(
 *          'Card'=>array(
 *            'mapping_type'=>self::HAS_MANY,
 *            'foreign_key'=>'uid', #关联表的键（与本主键关联）
 *            'mapping_name'=>'Card',#关联表名的映射
 *            'mapping_fields'=>'code',#要查询关联表的字段
 *            'mapping_limit'=>'0,2',#关联要返回的记录数目
 *            'mapping_order'=>'id DESC',#关联查询的排序
 *          )
 *     );
 *
 *
 *(3).多对多
 *  
 *      a.MANY_TO_MANY
 *      
 *        #UserModel类
 *        protected $_link=array(
 *          'Role'=>array(
 *            'mapping_type'=>self::MANY_TO_MANY,
 *            'relation_table'=>'user_role',#中间表的完整表名
 *            'foreign_key'=>'uid', #关联表的键（与本主键关联）
 *            'relation_forgein_key'=>'gid',#中间表的键
 *          )
 *        ); 
 *        
 *       
 * (4).关联操作
 * 
 *          a.查询
 *               $user=D('User');
 *               $user->relation(true)->select();
 *          
 *          b.增加
 *               $user=D('User');
 *               $data['name']=>'zhangsan';
 *               $data['Card']=>array(
 *                      'code'=>'12345678' 
 *               );
 *               $user->relation(true)->save($data);
 *            
 *          c.删除
 *                $user=D('User');
 *                $user->relation(true)->delete(1);
 *                
 *          d.更新
 *                $user=D('User');
 *               $data['name']=>'lisi';
 *               $data['Card']=>array(
 *                      'code'=>'12345678' 
 *               );
 *               $user->relation(true)->->where(array('id'=>1))->save($data);
 *                      
 * */