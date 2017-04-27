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

//生成url  http://www.xx.com/aa/b?x=1&y=2
function url($ctr,$mtd,$query=array()){
    if(!Router::$port=="80" && !Router::$port==""){
        $url=Router::$protocol."://".Router::$domain."/".strtolower($ctr)."/".strtolower($mtd);
    }else{
        $url=Router::$protocol."://".Router::$domain.":".Router::$port."/".strtolower($ctr)."/".strtolower($mtd);
    }
    if(count($query)){
        $url.="?".http_build_query($query);
    }
    return $url;
}

//跳转url
function jump($url){
    $scheme=cfg("request_scheme");
    if(strpos($url,"http://")===false && strpos($url,"https://")===false)
        $url=$scheme."://".$url;
    header("location:".$url);
}

//删除当前session
function drop_session($flag=false){
    if($flag){  //是否删除cookie
        $cookie_parames=session_get_cookie_params();
        setcookie(session_name(),"",time()-3600,$cookie_parames["path"],Router::$domain,$cookie_parames["secure"],$cookie_parames["httponly"]);
    }
    unset($_SESSION);
    session_destroy();
}
