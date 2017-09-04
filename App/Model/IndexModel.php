<?php
namespace App\Model;
use App\Server\DB\Instance as DB;
class IndexModel extends Model
{
    public static function getAll(){
        $db = DB::getInstance();

//        $rs = $db->table('bag_property')->where('id','>','1')->order('id','desc')->order('play_property_id','desc')->select();
        $rs = $db->table('bag_property')->whereIn('id',['1','2','3'])->where('id','=',4)->select();

        return $rs;
    }
}