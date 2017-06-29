<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/4/26
 * Time: 16:58
 */
class IndexCtr extends Controller{

    function index(){
        echo "<center><h1>Welcome to use this framework!</h1></center>";
    }
    function test(){
        $this->display_view("errosr.html","ssss");
    }


}