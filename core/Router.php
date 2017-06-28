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
    static public $app=null;
    static public $ctr=null;
    static public $mtd="index";
    static public $query=array();
    //初始化
    static function init(){
        self::$protocol=$_SERVER["REQUEST_SCHEME"];
        self::$domain=$_SERVER["SERVER_NAME"];
        self::$port=$_SERVER["SERVER_PORT"];
        //用于储存控制器和方法
        $path_arr=array();
        if(isset($_SERVER["PATH_INFO"]) && !empty($_SERVER["PATH_INFO"])){
            $path=trim("/",$_SERVER["PATH_INFO"]);
            if($path!=""){
                $path_arr=explode("/",$path);
            }
        }else{
            if(strpos($_SERVER["REQUEST_URI"],"?")!==false){
                $path=trim(substr($_SERVER["REQUEST_URI"],0,strpos($_SERVER["REQUEST_URI"],"?")),"/");
            }else{
                $path=trim($_SERVER["REQUEST_URI"],"/");
            }
            if($path!=""){
                $path_arr=explode("/",$path);
            }
        }
        switch (count($path_arr)){
            case 3:
                self::$app=ucfirst($path_arr[0]);
                self::$ctr=ucfirst($path_arr[1]);
                self::$mtd=$path_arr[2];
                break;
            case 2:
                self::$app=ucfirst($path_arr[0]);
                self::$ctr=ucfirst($path_arr[1]);
                self::$mtd=cfg("default_mtd");
                break;
            case 1:
                self::$app=ucfirst($path_arr[0]);
                self::$ctr=cfg("default_ctr");
                self::$mtd=cfg("default_mtd");
                break;
            case 0:
                self::$app=cfg("default_app");
                self::$ctr=cfg("default_ctr");
                self::$mtd=cfg("default_mtd");
        }
        if(strpos($_SERVER["REQUEST_URI"],"&")!==false){
            self::$query=explode("&",$_SERVER["QUERY_STRING"]);
        }
    }

    //执行路由
    static function run($ctr=null,$mtd=null){
        if(!self::$app){
            define("APP_PATH",cfg("default_app"));
        }else{
            define("APP_PATH",self::$app);
        }
        $ctr=$ctr!==null?$ctr:self::$ctr;
        $mtd=$mtd!==null?$mtd:self::$mtd;
        $obj=new $ctr();
        $obj->$mtd();
    }

}