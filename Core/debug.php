<?php
namespace Core;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

if($config['debug']){
    $whoops = new Run();
    $whoops->pushHandler ( new PrettyPageHandler () );
    $whoops->register();
}
else{
    //禁止错误输出
    error_reporting(0);
//
//    set_error_handler(function (){
//        die("error");
//    });
//    set_exception_handler(function (){
//        die("except");
//    });
    function error_reg(){
        $ar = array(
            E_ERROR => 'error',
            E_WARNING => 'warning',
            E_PARSE =>'prase',
            E_NOTICE => 'notice',
        );
        register_shutdown_function(function() use ($ar){
            $ers=error_get_last();
            if($ers['type']!=8 && $ers['type']){
                $er=$ar[$ers['type']].$ers['type'].': '.' '.$ers['message'].' => '.$ers['file'].' line:'.$ers['line'].' '.date('Y-m-d H:i:s')."\n";
                error_log($er,3,APP_PATH.'/Log/php_error.log');
                die('you have a '.$ar[$ers['type']].$ers['type']);
            }
        });
        set_error_handler(function($a,$b,$c,$d) use ($ar){
            if($a!=8 && $a){
                $er=$ar[$a].$a.': '.$b.' => '.$c.' line:'.$d.' '.date('Y-m-d H:i:s')."\n";
                error_log($er,3,APP_PATH.'/Log/php_error.log');
                die('you have a '.$ar[$a]);
            }
        },E_ALL ^ E_NOTICE);
    }
    error_reg();
}