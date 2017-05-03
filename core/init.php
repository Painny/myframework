<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/4/26
 * Time: 14:38
 */
//载入配置
$CONF=require_once CORE_PATH."config.php";
//载入错误配置
$ERROR=require_once APP_PATH."error.php";
//载入路由类
require_once CORE_PATH."Router.php";
//载入函数库
require_once CORE_PATH."func.php";
//载入基础控制器
require_once CORE_PATH."Controller.php";
//定义公共文件目录
define("COMMON_PATH",ROOT_PATH.cfg("common_dir").DIR_SEP);
//定义三方库目录
define("VENDOR_PATH",ROOT_PATH.cfg("vendor_dir").DIR_SEP);
//定义自动加载(从应用目录和公共目录匹配)
function __autoload($class){
    //优先从应用目录匹配
    $dir=APP_PATH.cfg("ctr_dir_name").DIR_SEP;
    $file=$dir.ucfirst($class)."Ctr.php";
    if(file_exists($file) && is_readable($file)){
        require_once $file;
        return;
    }
    //从公共目录匹配
    $dir=COMMON_PATH.cfg("ctr_dir_name").DIR_SEP;
    $file=$dir.ucfirst($class)."Ctr.php";
    if(!file_exists($file) || !is_readable($file)){
        exit("file not exists:".$file);
    }
    require_once $file;
}

//设置默认时区
date_timezone_set('Asia/Shanghai');
//初始化session
session_name(cfg("session_name"));
if(isset($_REQUEST[cfg("session_sign")])){
    session_id($_REQUEST[cfg("session_sign")]);
}
//设置session生命周期
session_cache_expire(cfg("session_expire"));
session_start();
//设置cookie生命周期
$cookie_parames=session_get_cookie_params();
setcookie(session_name(),session_id(),time()+cfg("cookie_expire"),$cookie_parames["path"],Router::$domain,$cookie_parames["secure"],$cookie_parames["httponly"]);

//路由初始化
Router::init();
//执行路由地址
Router::run();





