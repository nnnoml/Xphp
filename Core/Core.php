<?php
namespace Core;
use Dotenv\Dotenv;
class App{
    protected $config = [];

    public function __construct($config)
    {
        header('Content-Type: text/html; charset=UTF-8');
        $this->config = $config;
    }

    /**
     * 启动应用
     * 启动自动加载方法
     * 启动路由和Env拉取配置
     */
    public function run(){
        spl_autoload_register(array($this, 'loadClass'));
        $this->getEnv();
        $this->route();
    }

    /**
     * Env 获取Env配置
     */
    public function getEnv(){
        $dotenv = new Dotenv(APP_PATH);
        $dotenv->load();
    }

    /**
     * 路由
     * 获取到当前请求的控制器方法，可以单独拆分出来配置。
     */
    public function route()
    {
        $controllerName = $this->config['defaultController']; //默认控制器
        $actionName = $this->config['defaultAction'];//默认方法
        $param = array();//参数

        $url = $_SERVER['REQUEST_URI']; //获取当前url的路径地址 包括所有参数

        $position = strpos($url, '?');//判断第一个？出现的位置
        $url = $position === false ? $url : substr($url, 0, $position); //返回第一个？之前的所有参数

        $url = trim(str_replace('index.php','',$url), '/');// 删除前后的“/” 删除index.php

        if ($url) {
            // 使用“/”分割字符串，并保存在数组中
            $urlArray = explode('/', $url);
            // 删除空的数组元素 防止//出现
            $urlArray = array_filter($urlArray);
            // 获取控制器名
            $controllerName = $urlArray ? $urlArray[0] : $controllerName;

            // 获取动作名
            array_shift($urlArray);
            $actionName = $urlArray ? $urlArray[0] : $actionName;

            // 获取URL参数
            array_shift($urlArray);
            $param = $urlArray ? $urlArray : array();
        }

        // 判断控制器和操作是否存在
        $controller = "\\App\\Controller\\".$controllerName . 'Controller';

        if (!class_exists($controller)) {
            exit($controller . '控制器不存在');
        }

        if (!method_exists($controller, $actionName)) {
            exit($actionName . '方法不存在');
        }
        // 如果控制器和操作名存在，则实例化控制器，因为控制器对象里面
        // 还会用到控制器名和操作名，所以实例化的时候把他们俩的名称也
        // 传进去。结合Controller基类一起看
        $dispatch = new $controller($controllerName, $actionName);

        // $dispatch保存控制器实例化后的对象，我们就可以调用它的方法，
        // 也可以向方法中传入参数，以下等同于：$dispatch->$actionName($param)
        call_user_func_array(array($dispatch, $actionName), $param);
    }

    /**
     * 自动加载控制器和模型类
     * @param $class 要加载的类
     */
    public static function loadClass($class)
    {
        $class = APP_PATH .str_replace('\\','/',$class). '.php';
        if (file_exists($class)) {
            include $class;
        }
    }

}