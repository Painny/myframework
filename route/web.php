<?php
/**
 * Created by PhpStorm.
 * User: Pengyu
 * Date: 2019/8/29
 * Time: 14:46
 */

use Core\Router;

Router::get("index/test","Index@test");

Router::get("index/say/[content]","Index@say");

Router::get("/",function (){
    return "function";
});


