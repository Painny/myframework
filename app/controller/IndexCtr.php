<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/4/26
 * Time: 16:58
 */
class IndexCtr extends Controller{

    function index(){
        echo "<h1>Welcome to use this framework!</h1>";
    }
    function test(){
        $Dd=new Db();
        var_dump($Dd);
    }


}