<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/4/26
 * Time: 16:58
 */
class Index extends Controller{
    function __construct(){}

    function index(){
        echo "<center><h1>Welcome to use this framework!</h1></center>";
        phpinfo();
    }

    function test(){
        $this->display_view("test.html");
//        $this->display_data(0,"sasasasasa");
    }



}