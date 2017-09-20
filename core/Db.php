<?php
//数据库操作类
class Db {
    private $DB=null;       //数据库实例
    private $table=null;      //当前使用的主表 user
    private $field="*";     //当前查询字段 [x,y] 或 *
    private $where=[];      //当前查询条件 [id=>1] ["AND"=>[x=>1,y=>2]]
    private $join=[];       //连表查询关系 ['class'=>'ucid=cid']
    public  $param=[];      //预处理占位数据
    public  $last_sql=null; //最后一次执行语句
    public  $err_info=null; //当前错误信息
    
    
    function __construct(){
        if($this->DB==null){
            $dbms=cfg("db_type");
            $host=cfg("db_host");
            $dbName=cfg("db_name");
            $dsn="$dbms:host=$host;dbname=$dbName";
            try {
                $this->DB = new PDO($dsn, cfg("db_user"), cfg("db_pwd"));
            } catch (PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }
    }

    //获取一条数据  
    function get($table,$param1=null,$param2=null,$param3=null){
        $this->parse($table,$param1,$param2,$param3);
        $this->mkSql();
    }

    //解析参数
    //单表查询  get("user","uname,uage",["uid"=>1]) 或 get("user",["uname","uage"],["uid"=>1])
    //连表查询  get("user:class","ucid=cid","*",["uid"=>1]) 或 get("user:class:addr","ucid=cid,uaid=aid","*",["uid"=>1])
    //a:b a inner join b        a>b a left join b    a<b a right join b
    protected function parse($table,$param1=null,$param2=null,$param3=null){
        if(strpos($table,":")!==false || strpos($table,">")!==false || strpos($table,"<")!==false){  //多表
            $join=explode(":",$table);
            foreach($join as $k => $j){
                if($k==0){  //第一个是主表
                    $this->table=$table;
                    continue;
                }
                //表名
                if(strpos($j,":")){
                    $this->table=array_merge($this->table,explode(":",$j));
                }else if(strpos($j,">")){
                    $this->table=array_merge($this->table,explode(">",$j));
                }else if(strpos($j,"<")){
                    $this->table=array_merge($this->table,explode("<",$j));
                }
                //连表关系
                $join_key=$j;
                $join_value=explode(",",$param1)[$k];
                array_push($this->join,array($join_key=>$join_value));
            }
            //查询字段
            if($param2!==null){
                if(!is_array($param2)){
                    $this->field=explode(",",$param2);
                }else{
                    $this->field=$param2;
                }
            }
            //查询条件  ["uid"=>1]  ["AND"=>["uid"=>1,"uage"=>2]]
            $this->where=$param3;
        }else{  //单表
            //表名
            $this->table=$table;
            //查询字段
            if($param1!==null){
                if(!is_array($param1)){
                    $this->field=explode(",",$param1);
                }else{
                    $this->field=$param1;
                }
            }
            //查询条件  ["uid"=>1]  ["AND"=>["uid"=>1,"uage"=>2]]
            $this->where=$param2;
        }
    }

    //拼接语句
    protected function mkSql($page=null,$pagesize=null){
        //拼接查询字段
        $field="*";
        if(is_array($this->field)){
            $field=implode(",",$this->field);
        }
        //查询的表
        $table=$this->table;
        if(count($this->join)!=0){  //多表查询
           
        }
        
    }



}