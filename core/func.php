<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/4/26
 * Time: 16:23
 */
//动态读取修改配置
function cfg($key,$val=null){
    global $CONF;
    if($val!==null){
        $CONF[$key]=$val;
        return $val;
    }
    return isset($CONF[$key])?$CONF[$key]:null;
}

//获取错误信息
function error_info($code){
    global $ERROR;
    return isset($ERROR[$code])?$ERROR[$code]:"unknown mistake";
}

//载入三方库
function vendor($dirname,$filename){
    $file=VENDOR_PATH.$dirname.DIR_SEP.$filename;
    if(!file_exists($file) || !is_readable($file)){
        exit("file not exists:".$file);
    }
    require_once $file;
}
