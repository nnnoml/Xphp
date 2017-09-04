<?php
namespace Core;
use Core\BaseView as View;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/28
 * Time: 16:42
 */
class BaseController
{
    protected $_controller;
    protected $_action;
    protected $_view;

    // 构造函数，初始化属性，并实例化对应模型
    public function __construct($controller, $action)
    {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_view = new View();
    }

    // 分配变量
    public function assign($name, $value)
    {
        $this->_view->assign($name, $value);
    }

    // 渲染视图
    public function display($temp_url='')
    {
        $temp_url =  empty($temp_url) ? $this->_action : $temp_url;
        $this->_view->render($temp_url);
    }
}