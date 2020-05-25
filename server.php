<?php
/**
 * Created by PhpStorm.
 * User: Pengyu
 * Date: 2017/4/26
 * Time: 14:20
 */

require_once "vendor/autoload.php";

$server=new Pengyu\Server\Worker\Server("http://0.0.0.0:8081");

$server->on("workerStart",function (){
    $database=new \Medoo\Medoo([
        'database_type' => 'mysql',
        'database_name' => 'test',
        'server'        => 'localhost',
        'username'      => 'root',
        'password'      => 'root'
    ]);

    \Core\Container::bind("DB",$database);

    \Core\Router::clear();
    \Core\Router::load("./route/web.php");
});

$server->on("request",function ($data,$response){
    $url=explode("?",$data["server"]["REQUEST_URI"],2);
    try {
        $result=\Core\Router::runMatch($url[0],$data["server"]["REQUEST_METHOD"]);
        $response->end($result);
    } catch (Exception $exception) {
        //todo 异常分类判断
        if ($exception->getMessage() == "404 not found") {
            $response->status(404);
        }
        $response->status(500);
        $response->end($exception->getMessage());
    }
});

$server->run();