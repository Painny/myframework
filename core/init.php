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
//载入函数库
require_once CORE_PATH."func.php";
//载入基础控制器
require_once CORE_PATH."Controller.php";
//定义自动加载
function __autoload($class){
    $dir=APP_PATH.cfg("ctr_dir_name").DIR_SEP;
    $file=$dir.ucfirst($class)."Class.php";
    if(!file_exists($file) || !is_readable($file)){
        exit("file not exists:".$file);
    }
    require_once $file;
}
