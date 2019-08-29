<?php
/**
 * Created by PhpStorm.
 * User: pengyu
 * Date: 2019/8/29
 * Time: 15:01
 */

namespace App\Controller;


use Medoo\Medoo;

class Base
{
    protected $db;

    public function __construct(Medoo $db)
    {
        $this->db=$db;
    }

    public function end($data,$type=null)
    {
        if ($type == "json") {
            header("Content-Type: application/json");
        }

        if (!is_string($data)) {
            $data=json_encode($data);
        }

        return $data;
    }
}