<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/4/26
 * Time: 17:08
 */
class Controller{
    public $view_data=null;  //模板数据
    //访问没有的方法
    function __call($name, $arguments)
    {
        exit("Class Pengyu does not has method:".$name."()");
    }
    //设置没有的属性
    function __set($name, $value)
    {
        exit("Class Pengyu does not has property:".$name);
    }
    //获取没有的属性
    function __get($name)
    {
        exit("Class Pengyu does not has property:".$name);
    }
    //返回数据
    function display_data($code,$data=null,$format="json"){
        header("Content-type: application/".$format);
        if($code===0){
            echo json_encode(array("code"=>$code,"body"=>$data));
        }else{
            $error=error_info($code);
            echo json_encode(array("code"=>$code,"error"=>$error));
        }
    }
    //显示模板
    function display_view($tpl,$data=null){
        $this->view_data=$data;
        $file=APP_PATH.cfg("tpl_dir_name").DIR_SEP.$tpl;
        header("Content-type: text/html");
        if(!file_exists($file) || !is_readable($file)){
            require_once APP_PATH.cfg("tpl_dir_name").DIR_SEP.cfg("tpl_not_file");
        }else{
            require_once APP_PATH.cfg("tpl_dir_name").DIR_SEP.$tpl;
        }
    }



}