<?php
/*
 *   ORM，即Object-Relational Mapping（对象关系映射），它的作用是在关系型数据库和业务实体
 * 对象之间作一个映射，这样，我们在具体的操作业务对象的时候，就不需要再去和复杂的SQL语句打交道，
 * 只需简单的操作对象的属性和方法。就可以将程序中的对象自动持久化到关系数据库中
 * 
 * */
class ORM{
    
    public $host = '127.0.0.1';  //数据库地址
    public $dbname = 'websites'; //数据库名
    public $user = 'root';       //数据库用户名
    public $pwd = '123456';      //数据库密码
    public $port = '3306';      //数据库端口
    public $charset = 'utf8';    //数据库编码
    private $conn = null;       //数据库链接资源
    private $alias =array();     //记录全局的语句参数
    private $sql;               //最后生成的sql语句
    
    
    public function __construct(){
        if( is_null( $this->conn ) ){
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset;port=$this->port";
            $this->conn = new PDO( $dsn, $this->user, $this->pwd );
        }
    }
  
    
    //field语句【$this->filed("name,id")】
    public function field( $field ){
        if( !is_string( $field ) ){
            throw new exception("field语句的参数必须为字符串");
        }
        $this->alias['field'] = $field;
        return $this;
    }
  
    
    //table语句【$this->table("website")】
    public function table( $table ){
        if( !is_string( $table ) ){
            throw new exception("table语句的参数必须为字符串");
        }
        $this->alias['table'] = $table;
        return $this;
    }
    
    
    //where语句【$this->where("id=1")  $this->where(array("id"=>1,"name"=>'zhangsan'))】
    public function where( $where ){
        $this->alias['where'] = '';
        if( is_array( $where ) ){
            foreach( $where as $key=>$value ){
                //追加条件，and逻辑
                $this->alias['where'] .= ($key. ' = ' . $value . ' and ');
            }
            $this->alias['where'] = rtrim( $this->alias['where'], 'and ' );//从字符串右侧移除字符and
        }else if( is_string( $where ) ){
            $this->alias['where'] = $where;
        }else{
            throw new exception("where语句的参数必须为数组或字符串");
        }
        return $this;
    }
   
    
    //构建查询sql语句
    public function ParseSelectSql(){
      
        //构建sql语句
        $this->sql = 'select *';
        
        //当field不为空时，字符串替换*为field字段
        if( !empty( $this->alias['field'] ) ){
            $this->sql = str_replace( '*', $this->alias['field'], $this->sql );
        }
        
        //指定当查询的table
        if( empty( $this->alias['table'] ) ){
            throw new exception("请用table子句设置查询表");
        }else{
            $this->sql .= ' from ' . $this->alias['table'];
        }
        
        //当where不为空时，指定where条件
        if( !empty( $this->alias['where'] ) ){
            $this->sql .= ' where ' . $this->alias['where'];
        }
    }
   
    
    //查询语句【$this->select()】
    public function select(){
        $this->ParseSelectSql();
        $result = $this->conn->query( $this->sql )->fetchAll( PDO::FETCH_ASSOC );
        return $result;
    }
    
    
    //构建添加sql语句
    public function ParseAddSql(){

        //构建sql语句
        $this->sql = 'insert into ';
        
        //指定table
        if( empty( $this->alias['table'] ) ){
            throw new exception("请用table子句设置添加表");
        }else{
            $this->sql .= $this->alias['table'].' values';
        }
    }
    
    
    //添加数据【$this->add(array(1,'zhansan','http://www.baidu.com',2,'CN')】
    public function add( $data )
    {
        if( !is_array( $data ) ){
            throw new exception("添加数据add方法参数必须为数组");
        }
        $this->ParseAddSql();
        $this->sql.="(";
        foreach( $data as $value ){
            if(is_numeric($value)){
                $this->sql .="$value,";
            }else{
                $this->sql.="'"."$value"."',";    
            }
        }
        $this->sql = rtrim( $this->sql, ',' );
        $this->sql.=")";
        $this->conn->exec($this->sql);
        echo "插入成功";
    }
    
    
    //构建更新sql语句
    public function ParseUpdateSql(){
        
        //构建sql语句
        $this->sql = 'update ';
        if( empty( $this->alias['table'] ) ){
            throw new exception("请用table子句设置修改表");
        }else{
            $this->sql .= $this->alias['table'] . ' set ';
        }
        if( empty( $this->alias['where'] ) ){
            throw new exception("更新语句必须有where子句指定条件");
        }
    }
    
    
    //更新语句【$this->update(array('id'=>1,'name'=>'zhangsan'))】
    public function update( $data ){
        if( !is_array( $data ) ){
            throw new exception("更新数据update方法参数必须为数组");
        }
        $this->ParseUpdateSql();
        foreach( $data as $key=>$value ){
            if(is_numeric($value)){
                $this->sql .= "{$key}={$value},";
            }else{
                $this->sql.= "{$key}='"."{$value}"."',";
            }
        }
        $this->sql = rtrim( $this->sql, ",")." where ".$this->alias['where'];
        $this->conn->exec( $this->sql );
        echo "更新成功";
    }
    
    
    //构建删除sql语句
    public function ParseDeleteSql(){
        $this->sql = 'delete from ';
        if( empty( $this->alias['table'] ) ){
            throw new exception("请用table子句设置删除表");
        }else{
            $this->sql .= $this->alias['table'];
        }
        if( empty( $this->alias['where'] ) ){
            throw new exception("删除语句必须有where子句指定条件");
        }
        $this->sql .= ' where ' . $this->alias['where'];
    }
    
    
    //删除语句【$this->delete()】
    public function delete(){
        $this->ParseDeleteSql();
        $this->conn->exec( $this->sql );
        echo "删除成功".$this->sql;
    }
   
 
}