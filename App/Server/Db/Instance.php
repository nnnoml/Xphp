<?php
namespace App\Server\Db;

class Instance implements DbInterface {
    private static $instance;
    private $conn;
    private $table;
    private $where;
    private $order;
    private function  __construct(){}

    public function __clone(){
        //当用户clone操作时产生一个错误信息
        trigger_error("Can't clone object",E_USER_ERROR);
    }

    /**
     * 选表
     * @param $table
     * @return $this
     */
    public function table($table){
        $this->table = $table;
        return $this;
    }

    /**
     * where 条件入栈
     * @param $key   键
     * @param $flag  标志默认 =
     * @param $value 值
     * @return $this
     */
    public function where($key,$flag,$value){
        if ($this->where == '')
            $this->where = ' where ';
        else $this->where .=' and ';
        $this->where .= $key.' '.$flag.' '.$value.' ';
        return $this;
    }

    /**
     * where IN
     * @param $key
     * @param $arr
     * @return Instance
     */
    public function whereIn($key,$arr){
        if(is_array($arr)){
           return $this->where($key,'in','('.implode(',',$arr).')');
        }
        else  trigger_error("whereIN parame not array ",E_USER_ERROR);
    }
    public function select(){
        $this->order = rtrim($this->order,', ');
        $rs = $this->connect()->query('select * from '.$this->table.$this->where.$this->order);
        return $rs;
    }

    public function order($order,$sort){
        if ($this->order == '')
            $this->order = ' order by ';
        $this->order .= $order.' '.$sort.' , ';
        return $this;
    }
    /**
     * @return mixed
     */
    public function connect($type='mysql')
    {
        $config = include(APP_PATH.'Config/App.conf.php');
        $this->table = $config[$type]['prefix'].$this->table;
        $host = $config[$type]['host'];
        $dbname = $config[$type]['dbname'];
        $user = $config[$type]['user'];
        $pwd = $config[$type]['pwd'];
        $charset = $config[$type]['charset'];

        if(empty($this->conn) && $type=='mysql'){

            $this->conn = new \PDO("mysql:host=$host;dbname=$dbname", "$user", "$pwd");
            $this->conn->query("set names $charset;");

            if(!$this->conn){
                throw new Exception("mysql connect error".$this->conn->errorInfo());
            }
        }
        return $this->conn;
    }

    public static function getInstance(){
        if(!(self::$instance instanceof self)){
            self::$instance = (new self());
        }
        return self::$instance;
    }

}