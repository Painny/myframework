<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/26
 * Time: 21:39
 */

class Router{
    static public $protocol="http";
    static public $domain=null;
    static public $port="80";
    static public $ctr="Index";
    static public $mtd="index";
    static public $query=array();
    //初始化
    static function init(){
        self::$protocol=$_SERVER["REQUEST_SCHEME"];
        self::$domain=$_SERVER["SERVER_NAME"];
        self::$port=$_SERVER["SERVER_PORT"];
        if(isset($_SERVER["PATH_INFO"]) && !empty($_SERVER["PATH_INFO"])){
            $path_arr=explode("/",$_SERVER["PATH_INFO"]);
        }else{
            if(strpos($_SERVER["REQUEST_URI"],"?")!==false){
                $path=trim(substr($_SERVER["REQUEST_URI"],0,strpos($_SERVER["REQUEST_URI"],"?")),"/");
            }else{
                $path=trim($_SERVER["REQUEST_URI"],"/");
            }
            $path_arr=strpos($_SERVER["REQUEST_URI"],"/")!==false?explode("/",$path):array();
        }
        switch (count($path_arr)){
            case 3:
            case 2:
                self::$ctr=$path_arr[0];
                self::$mtd=$path_arr[1];break;
            case 1:
                self::$ctr=$path_arr[0];
        }
        if(strpos($_SERVER["REQUEST_URI"],"&")!==false){
            self::$query=explode("&",$_SERVER["QUERY_STRING"]);
        }
    }

    //执行路由
    static function run($ctr=null,$mtd=null){
        $ctr=$ctr!==null?$ctr:self::$ctr;
        $mtd=$mtd!==null?$mtd:self::$mtd;
        $obj=new $ctr();
        $obj->$mtd();
    }

}