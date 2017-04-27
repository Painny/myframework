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
    "tpl_not_file"  =>  "error.html",   //模板不存在时显示的模板
    "session_name"  =>  "PENG",         //session的name
    "session_sign"  =>  "stoken",       //浏览器禁用cookie时传送sessionid的表示字段
    "cookie_expire" =>  3600*24*7,      //cookie生命周期 单位秒
    "session_expire"=>  60*24*7,        //session生命周期 单位分
    "default_ctr"   =>  "Index",        //默认控制器
    "default_mtd"   =>  "index",        //默认方法
    "common_dir"    =>  "common",       //公共目录
    "vendor_dir"    =>  "vendor",       //三方库目录

);