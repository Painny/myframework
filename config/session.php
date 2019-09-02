<?php
/**
 * Created by PhpStorm.
 * User: pengyu
 * Date: 2019/8/26
 * Time: 11:38
 */
return array(
    'driver'    =>  'file',
    'name'      =>  'PHPSESSION',
    'expire'    =>  86400,
    'encrypt'   =>  false,
    'autostart' =>  false,
    'handler'    =>  [
        'file'  =>  [
            'path'  =>  'runtime/session'
        ],
        'redis' =>  [
            'host'      =>  'localhost',
            'port'      =>  6379,
            'password'  =>  '',
            'db'        =>  0
        ]
    ]
);