<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/4/26
 * Time: 14:45
 */
return array(
    "ctr_dir_name"  =>  "controller",   //控制器目录名
    "mdl_dir_name"  =>  "model",        //模型目录名
    "tpl_dir_name"  =>  "tpl",          //视图目录名
    "common_dir"    =>  "common",       //公共目录名
    "upload_dir"    =>  "attachment",   //上传文件等附件目录
    "static_dir"    =>  "public",       //静态文件目录 css js img

    "session_name"  =>  "PENG",         //session的name
    "session_sign"  =>  "stoken",       //浏览器禁用cookie时传送sessionid的表示字段
    "cookie_expire" =>  3600*24*7,      //cookie生命周期 单位秒
    "session_expire"=>  60*24*7,        //session生命周期 单位分

    "db_type"       =>  "mysql",        //数据库类型
    "db_host"       =>  "localhost",    //数据库主机
    "db_name"       =>  "test",         //数据库名
    "db_user"       =>  "root",         //数据库用户名
    "db_pwd"        =>  "root",         //数据库密码
);