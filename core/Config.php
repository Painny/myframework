<?php
/**
 * Created by PhpStorm.
 * User: pengyu
 * Date: 2019/8/30
 * Time: 15:05
 */

namespace Core;


class Config
{
    protected static $instance;

    protected $data;

    protected function __construct(){}

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance=new self();
        }
        return self::$instance;
    }

    public static function loadDir($dir)
    {
        if (!file_exists($dir)) {
            throw new \Exception("config dir is not exists");
        }

        $handle=opendir($dir);
        while (($file=readdir($handle)) !== false) {
            if ($file == "." || $file == "..") {
                continue;
            }

            $name=basename($file,".php");
            self::getInstance()->data[$name]=require_once $dir.DIRECTORY_SEPARATOR.$file;
        }
        closedir($handle);
    }

    public static function load($file)
    {
        if (!file_exists($file)) {
            throw new \Exception("config file is not found");
        }

        $name=basename($file,".php");
        self::getInstance()->data[$name]=require_once $file;
    }

    public static function get($key,$default=null)
    {
        $data=self::getInstance()->data;
        if (!$key) {
            return $data;
        }

        $keys=explode(".",$key);
        foreach ($keys as $index) {
            if (!isset($data[$index])) {
                return $default;
            }
            $data=$data[$index];
        }

        return $data;
    }

    public static function set($key,$value)
    {
        $keys=explode(".",$key);

        $data=&self::getInstance()->data;
        foreach ($keys as $index) {
            if (!isset($data[$index])) {
                return false;
            }
            $data=&$data[$index];
        }
        $data=$value;
        return true;
    }

}