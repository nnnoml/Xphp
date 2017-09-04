<?php
namespace Core;

class BaseView{
    protected $variables = array();
    protected $blade;

    protected $views;
    protected $cache;

    function __construct()
    {
        $this->views = APP_PATH . 'App/view';
        $this->cache = APP_PATH . 'App/view/cache';

    }

    // 分配变量
    public function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }

    // 渲染显示
    public function render($temp_url)
    {
        extract($this->variables);

        $temp_url = $this->views.'/'.$temp_url.'.php';

        if (file_exists($temp_url)) {
            include ($temp_url);
        } else {
            die('template not find');
        }
    }
}