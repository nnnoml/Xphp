<?php
namespace App\Model;
use App\Server\DB\Instance as DB;
class IndexModel extends Model
{
    public static function getAll(){
        $db = DB::getInstance();

//        $rs = $db->table('bag_property')->where('id','>','1')->order('id','desc')->order('play_property_id','desc')->select();
        $rs = $db->table('bag_property')->select();

        return $rs;
    }
}