<?php
/**
 * Created by PhpStorm.
 * User: Pengyu
 * Date: 2017/4/26
 * Time: 16:23
 */


if (!function_exists("config")) {
    function config($key,$value=null)
    {
        //获取
        if ($value === null) {
            return \Core\Config::get($key);
        }

        return \Core\Config::set($key,$value);
    }
}

