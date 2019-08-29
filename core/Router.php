<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/26
 * Time: 21:39
 */
namespace Core;

class Router
{
    protected static $instance;

    protected $map=[];

    protected $namespace='App\Controller';

    const METHODS=['GET','POST','DELETE','PUT'];

    const PATTERN=[
        '/\[[^\]]+\]\//'  =>  '([^\/]+)/',
        '/\[[^\]]+\]/'  =>  '([^\/]+)',
    ];

    protected function __construct(){}

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance=new self();
        }

        return self::$instance;
    }

    public static function get($expression,$action)
    {
        self::getInstance()->add($expression,$action,'GET');
    }

    public static function post($expression,$action)
    {
        self::getInstance()->add($expression,$action,'POST');
    }

    public static function any($expression,$action)
    {
        self::getInstance()->add($expression,$action);
    }

    public static function delete($expression,$action)
    {
        self::getInstance()->add($expression,$action,'DELETE');
    }

    public static function put($expression,$action)
    {
        self::getInstance()->add($expression,$action,'PUT');
    }

    public static function runMatch($url,$method)
    {
        $route=self::getInstance()->match($url,$method);
        if (!$route) {
            //todo
            throw new \Exception("404 not found");
        }

        return self::$instance->dispatch($route);
    }

    public function add($expression,$action,$method="*")
    {
        if ($expression !== "/") {
            $expression=trim($expression,"/");
        }

        if ($method == "*") {
            $method=self::METHODS;
        } else {
            $method=[$method];
        }

        $expression=addcslashes($expression,"/");
        //匹配的正则表达式
        $pattern=preg_replace(array_keys(self::PATTERN),self::PATTERN,$expression);

        $route=[
            'action'    =>  self::$instance->namespace.'\\'.$action,
            'method'    =>  $method,
            'pattern'   =>  '/^'.$pattern.'$/'
        ];

        self::$instance->map[$expression]=$route;
    }

    // /book/[id]/info   /book/1/info
    public function match($url,$method)
    {
        if ($url !== "/") {
            $url=trim($url,"/");
        }

        foreach ($this->map as $expression => $route) {
            if (preg_match_all($route["pattern"],$url,$matches)) {
                if (!in_array($method,$route["method"])) {
                    continue;
                }
                $route["param"]=[];
                if (count($matches) >= 2) {
                    unset($matches[0]);
                    foreach ($matches as $match) {
                        $route["param"][]=$match[0];
                    }
                }
                return $route;
            }
        }
        return false;
    }

    //todo 目前没有中间件调用
    public function dispatch($route)
    {
        if ($route["action"] instanceof \Closure) {
            return call_user_func_array($route["action"],$route["param"]);
        } else {
            $action=explode("@",$route["action"],2);
            $ctl=Container::get($action[0]);
            return call_user_func_array([$ctl,$action[1]],$route["param"]);
        }
    }

}

