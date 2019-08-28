<?php
/**
 * Created by PhpStorm.
 * User: pengyu
 * Date: 2019/8/28
 * Time: 16:38
 */

namespace Core;

class Container
{
    protected static $instance;

    //标识对应的类名或闭包函数  ['test'=>'App\Controller\Test']
    protected $bindList=[];

    //标识或类名对应的实例化对象 ['App\Controller\Test'=>object,'tag'=>object]
    protected $bindInstance=[];

    protected function __construct(){}

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance=new self();
        }
        return self::$instance;
    }

    public static function bind($abstract,$concrete)
    {
        return self::$instance->bindTo($abstract,$concrete);
    }

    public function bindTo($abstract,$concrete)
    {
        if (is_object($concrete)) {
            $this->bindInstance[$abstract]=$concrete;
        } else {
            $this->bindList[$abstract]=$concrete;
        }
        return;
    }

    public static function get($abstract)
    {
        return self::$instance->build($abstract);
    }

    public function build($abstract,$param)
    {
        if (isset($this->bindInstance[$abstract])) {
            return $this->bindInstance[$abstract];
        } else if ($this->bindList[$abstract] instanceof \Closure) {
            //todo 闭包 判断是否有参数需要生成
        } else {
            //todo 类名 判断是否存在，并且是否有参数需要生成
        }
    }

}