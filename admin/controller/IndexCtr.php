<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/4/26
 * Time: 16:58
 */
class IndexCtr extends Controller{

    function index(){
        $this->display_data(0,["a"=>1,"b"=>["x"=>2,"y"=>333]]);
    }



}