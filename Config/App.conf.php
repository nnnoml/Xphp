<?php
return [
    'debug' => true, //开启whoops错误日志
    // 默认控制器和操作名
    'defaultController'=> 'Index',
    'defaultAction' => 'index',

//    'aliases' => [
//        'App'       => Illuminate\Support\Facades\App::class,
//    ],

    'mysql' => [
        'host'       => env('host','localhost'),
        'user'       => env('user','root'),
        'pwd'        => env('pwd','123'),
        'dbname'    => env('dbname','gamezz'),
        'charset'   => 'utf8',
        'prefix'    => env('prefix','zz_'),
    ],
];