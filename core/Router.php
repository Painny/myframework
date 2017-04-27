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
    static public $ctr=null;
    static public $mtd=null;
    static public $query=array();
    //初始化
    static function init(){
        self::$protocol=$_SERVER["REQUEST_SCHEME"];
        self::$domain=$_SERVER["SERVER_NAME"];
        self::$port=$_SERVER["SERVER_PORT"];
        //用于临时储存控制器和方法
        $path_arr=array();
        if(isset($_SERVER["PATH_INFO"]) && !empty($_SERVER["PATH_INFO"])){
            $path=str_replace("index.php","",trim($_SERVER["PATH_INFO"],"/"));
            if($path!=""){
                $path_arr=explode("/",$path);
            }
        }else{
            if(strpos($_SERVER["REQUEST_URI"],"?")!==false){
                $path=str_replace("index.php","",trim(substr($_SERVER["REQUEST_URI"],0,strpos($_SERVER["REQUEST_URI"],"?")),"/"));
            }else{
                $path=str_replace("index.php","",trim($_SERVER["REQUEST_URI"],"/"));
            }
            if($path!=""){
                $path_arr=explode("/",$path);
            }
        }
        switch (count($path_arr)){
            case 3:
            case 2:
                self::$ctr=$path_arr[0];
                self::$mtd=$path_arr[1];break;
            case 1:
                self::$ctr=$path_arr[0];
                self::$mtd=cfg("default_mtd");break;
            case 0:
                self::$ctr=cfg("default_ctr");
                self::$mtd=cfg("default_mtd");break;
        }
        if(strpos($_SERVER["REQUEST_URI"],"&")!==false){
            self::$query=explode("&",$_SERVER["QUERY_STRING"]);
        }
    }

    //执行路由
    static function run($ctr=null,$mtd=null){
        $ctr=$ctr!==null?$ctr:self::$ctr;
        $mtd=$mtd!==null?$mtd:self::$mtd;
        //只能访问应用里面的控制器方法
        $file=APP_PATH.cfg("ctr_dir_name").DIR_SEP.ucfirst($ctr)."Ctr.php";
        if(!file_exists($file) || !is_readable($file)){
            exit("file not exists:".$file);
        }
        require_once $file;
        $obj=new $ctr();
        $obj->$mtd();
    }

}