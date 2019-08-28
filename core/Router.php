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
        self::$instance->add($expression,$action,'GET');
    }

    public static function post($expression,$action)
    {
        self::$instance->add($expression,$action,'POST');
    }

    public static function any($expression,$action)
    {
        self::$instance->add($expression,$action);
    }

    public static function delete($expression,$action)
    {
        self::$instance->add($expression,$action,'DELETE');
    }

    public static function put($expression,$action)
    {
        self::$instance->add($expression,$action,'PUT');
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

        foreach ($this->map as $expression => $item) {
            if (preg_match_all($item["pattern"],$url,$matches)) {
                if (!in_array($method,$item["method"])) {
                    continue;
                }
                $item["param"]=[];
                if (count($matches) >= 2) {
                    unset($matches[0]);
                    foreach ($matches as $match) {
                        $item["param"][]=$match[0];
                    }
                }
                return $item;
            }
        }
        return false;
    }

    public function run()
    {

    }

}

$router=Router::getInstance();
$router->add("book/[s]/info/[id]/s","test","GET");
var_dump($router->match("book/2/info/3/s","GET"));