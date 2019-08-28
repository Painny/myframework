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

    public function bind($abstract,$concrete)
    {

    }

}