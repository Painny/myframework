<?php
//数据库操作类
class Db {
    private static $DB=null;  //数据库实例
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

    function find(){

    }



}