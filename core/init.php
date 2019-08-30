<?php
/**
 * Created by PhpStorm.
 * User: Pengyu
 * Date: 2017/4/26
 * Time: 14:38
 */

require_once "../vendor/autoload.php";

//初始化数据库
$database=new \Medoo\Medoo([
    'database_type' => 'mysql',
    'database_name' => 'blog',
    'server'        => 'localhost',
    'username'      => 'root',
    'password'      => 'root'
]);

\Core\Container::bind("Medoo\Medoo",$database);

\Core\Router::clear();
\Core\Router::load("../route/web.php");

//todo 初始化session cache等，设置时区


