<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\StaticAnalysis\Cache;
class Permission{
    public $count_support_online;
    static function check($p_prefix){
        $acc_rank = Auth::user()->rank;
        $pid = DB::selectOne('select * from settings where action=?',[$p_prefix]);
        $paccess = DB::selectOne('select * from settings_permission where option=?',[$pid->id]);
        if($acc_rank >= $paccess->web_rank){
            return true;
        }else{
            return false;
        }
    }

    static function get_points($prefix){
        $s = DB::selectOne('select * from settings where action=?',[$prefix]);
        return $s->value;
    }

    public static function get_support_online(){
        $s = DB::selectOne('select * from settings where action=?',['support_levels']);
        $ss = DB::selectOne('select * from settings_permission where option=?',[$s->id]);
        $get_usr = DB::select('select * from users where rank >= ?',[$ss->web_rank]);
        $arr = array();
        foreach($get_usr as $user){
            $inner = array(
                'id' => $user->id
            );
            array_push($arr,$inner);
        }
        return $arr;
    }

    public static function get_guild_online(){
        $s = DB::selectOne('select * from users where id=?',[Auth::user()->id]);
        $guild_online = array();
        if($s->guild_id > 0){
            $guild = DB::select('select * from users where guild_id=?',[$s->guild_id]);
            foreach($guild as $g_online){
                $tmp = array(
                    'go_id' => $g_online->id
                );
                array_push($guild_online,$tmp);
            }
        }
        return $guild_online;
    }
    

}