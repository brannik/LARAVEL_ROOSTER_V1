<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
class Settings{
    
    function __construct(){
        
    }
    static function get_settings(){
        $s = DB::select('select * from settings');
        $settings = array();
        foreach($s as $option){
            $mr = DB::selectOne('select * from settings_permission where option=?',[$option->id]);
            $rnk = DB::selectOne('select * from web_ranks where id=?',[$mr->web_rank]);
            $arr = array(
                'opt_name'      => $option->action,
                'opt_id'        => $option->id,
                'opt_value'     => $option->value,
                'min_rank'      => $rnk->rank_name,
                'description'   => $option->description,
                'has_value'     => $option->it_has_value
            );
            array_push($settings,$arr);
        }
        return $settings;
    }
}