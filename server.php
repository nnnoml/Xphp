<?php
// 应用目录为当前目录
define('APP_PATH', __DIR__.'/');
//加载composer
require_once (APP_PATH.'vendor/autoload.php');
// 加载框架文件
require_once (APP_PATH . 'Core/Core.php');
//加载公共函数
require_once (APP_PATH.'Core/helpers.php');
// 加载配置文件
$config = require_once(APP_PATH . 'Config/App.conf.php');
// 加载whoops 详细错误提示
require_once(APP_PATH . 'Core/debug.php');

// 实例化框架类
(new \Core\App($config))->run();
