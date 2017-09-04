<?php
namespace App\Server\Db;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/29
 * Time: 11:33
 */

interface DbInterface{

    public function connect($type);
    public function table($table);
    public function where($key,$flag,$value);
    public function select();
    public function order($order,$sort);

}

