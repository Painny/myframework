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
        return self::getInstance()->bindTo($abstract,$concrete);
    }

    public function bindTo($abstract,$concrete)
    {
        if (is_object($concrete)) {
            $this->bindInstance[$abstract]=$concrete;
        } else {
            $this->bindList[$abstract]=$concrete;
        }
        return true;
    }

    public static function get($abstract,$param=[])
    {
        return self::getInstance()->build($abstract,$param);
    }

    public function build($abstract,$param)
    {
        if (isset($this->bindInstance[$abstract])) {
            $obj=$this->bindInstance[$abstract];
        } else if ($this->bindList[$abstract] instanceof \Closure) {
            $obj=$this->invokeFunction($abstract,$param);
            $this->bindTo($abstract,$obj);
        } else {
            $obj=$this->invokeClass($abstract,$param);
            $this->bindTo($abstract,$obj);
        }

        return $obj;
    }

    protected function invokeFunction($abstract,$param)
    {
        $reflection=new \ReflectionFunction($abstract);

        //是否需要参数
        if ($reflection->getNumberOfParameters() == 0) {
            return $reflection->invoke();
        }

        $args=$this->makeParam($reflection,$param);
        return $reflection->invokeArgs($args);
    }

    protected function invokeClass($abstract,$param)
    {
        $reflection=new \ReflectionClass($abstract);
        $constructor=$reflection->getConstructor();

        if (!$constructor) {
            return $reflection->newInstance();
        }

        if (!$constructor->isPublic()) {
            throw new \Exception("construct method is not public");
        }

        $args=$this->makeParam($constructor,$param);

        return $reflection->newInstanceArgs($args);
    }

    protected function makeParam($reflection,$vars)
    {
        $params=$reflection->getParameters();
        $args=[];

        foreach ($params as $key => $param) {
            $class=$param->getClass();
            if ($class) {
                $className=$class->getName();
                if (isset($vars[$key]) && $vars[$key] instanceOf $className) {
                    $args[]=$vars[$key];
                } else {
                    $args[]=$this->build($param->getClass()->getName(),$vars);
                }
            } else if (isset($vars[$key])) {
                $args[]=$vars[$key];
            } else if($param->isDefaultValueAvailable ()) {
                $args[]=$param->getDefaultValue();
            } else {
                throw new \Exception("miss param ".$param->getName());
            }
        }

        return $args;
    }

}