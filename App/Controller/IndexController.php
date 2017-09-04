<?php
namespace App\Controller;
use App\Model\IndexModel as Index;

class IndexController extends Controller
{
    public function index(){

        $data = Index::getAll();
        $keyword = 'keys';
        $items = 'item';
        $this->assign('title', '全部条目');
        $this->assign('keyword', $keyword);
        $this->assign('items', $items);
        $this->assign('data', $data);

        $this->display('Admin/index',compact('keyword','items','title'));
    }
}