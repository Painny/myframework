<?php
/**
 * Created by PhpStorm.
 * User: pengyu
 * Date: 2019/8/26
 * Time: 11:14
 */

return array(
    'driver'    =>  'file',
    'prefix'    =>  '',
    'expire'    =>  86400,
    'handler'    =>  [
        'file'  =>  [
            'path'  =>  'runtime/cache'
        ],
        'redis' =>  [
            'host'      =>  'localhost',
            'port'      =>  6379,
            'password'  =>  '',
            'db'        =>  0
        ]
    ]
);