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
        'host'       => env('host',''),
        'user'       => env('user',''),
        'pwd'        => env('pwd',''),
        'dbname'    => env('dbname',''),
        'charset'   => 'utf8',
        'prefix'    => env('prefix','zz_'),
    ],
];