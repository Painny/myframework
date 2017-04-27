<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/4/26
 * Time: 16:58
 */
class Index extends Controller{
    function __construct()
    {

    }
    function index(){
        echo "index";
    }
    function say(){
        vendor("say","say.php");
        $say=new Say();
        $say->sayhello();
    }


}