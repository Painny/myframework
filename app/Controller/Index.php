<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/4/26
 * Time: 16:58
 */
namespace App\Controller;

use Core\Container;

class Index extends Base
{

    public function test()
    {
        $data=Container::get("DB")->select("user","*");
        return $this->end(["code"=>0,"data"=>$data,"msg"=>"ok"]);
    }

    public function say($content)
    {
        return $this->end("content is ".$content);
    }

}