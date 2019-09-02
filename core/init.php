<?php
/**
 * Created by PhpStorm.
 * User: Pengyu
 * Date: 2017/4/26
 * Time: 14:38
 */

require_once "../vendor/autoload.php";

\Core\Config::loadDir("../config");

\Core\Container::bind("DB",function (){
    return new \Medoo\Medoo([
        'database_type' =>  config("db.driver"),
        'database_name' =>  config("db.db"),
        'server'        =>  config("db.host"),
        'port'          =>  config("db.port"),
        'username'      =>  config("db.user"),
        'password'      =>  config("db.password"),
        'prefix'        =>  config("db.prefix")
    ]);
});

\Core\Router::clear();
\Core\Router::load("../route/web.php");

date_default_timezone_set(config("app.timezone"));

//todo 初始化session cache等

//获取url和method
$url=explode("?",$_SERVER["REQUEST_URI"],2);
$method=$_SERVER["REQUEST_METHOD"];
try {
    $data=\Core\Router::runMatch($url[0],$method);
} catch (Throwable $throwable) {
    http_response_code(500);
    echo $throwable->getMessage();
    return;
}

echo $data;

//todo 收尾工作