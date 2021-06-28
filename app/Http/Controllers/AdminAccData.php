<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class AdminAccData{
    
    public static function check_rate($user_id){
        $did_i_rate_you = 0;
        $my_rating = "Neutral";
        $s = DB::selectOne('select * from rates where from_user=? and to_user=?',[Auth::user()->id,$user_id]);
        if(!empty($s)){
            $did_i_rate_you = 1;
            $my_rating = $s->type;
        }
        return array('check_rate' => $did_i_rate_you, 'rate' => $my_rating);
    }
    public static function get_rank(){
        $s = DB::select('select * from web_ranks');
        $ranks = array();
        foreach($s as $rank){
            $arr = array(
                'rank' => $rank->rank_name
            );
            array_push($ranks,$arr);
        }
        return $ranks;
    }
    public static function get_current_webrank($user_id){
        $s = DB::selectOne('select * from users where id=?',[$user_id]);
        $rnk = DB::selectOne('select * from web_ranks where id=?',[$s->rank]);
        return $rnk->rank_name;
    }
    public static function calc_comunity_rank($acc_id){
        
        $p = DB::selectOne('select * from users where id=?',[$acc_id]);
        $points = $p->comunity_points;
        $s = DB::selectOne('select * from comunity_ranks where ? BETWEEN requirement_min AND requirement_max',[$points]);
        $this_min = $s->requirement_min ;
        $this_max = $s->requirement_max;
        $rank = $s->name;
        $percent = ($points / $s->requirement_max) * 100;
        $percent = sprintf("%3d", $percent);
        
        return array('rank' => $rank,'percent' => $percent,'current' => $points,'maximum' => $this_max, 'minimum' => $this_min);
    }
    public static function get_current_rank($guild_id,$rank_id){
        $rank_name = "No Guild";
        if($rank_id > 0 && $guild_id > 0){
            $s = DB::selectOne('select * from guild_ranks where guild_id=? and id=?',[$guild_id,$rank_id]);
            $rank_name = $s->name;
        }
        return $rank_name;
    }

    public static function get_guilds(){
        $s = DB::select('select * from guild');
        $guilds = array();
        foreach($s as $guild){
            $arr = array(
                'guild_name'    => $guild->name
            );
            array_push($guilds,$arr);
        }
        return $guilds;
    }
    public static function get_guild_name($guild_id){
        $gname = "No guild";
        if($guild_id > 0){
            $s = DB::selectOne('select * from guild where id=?',[$guild_id]);
            $gname = $s->name;
        }
        return $gname;
    }

    public static function get_guild_ranks($guild_id){
        $s = DB::select('select * from guild_ranks where guild_id=?',[$guild_id]);
        $g_ranks = array();
        foreach($s as $g_rank){
            $arr = array(
                'rank_name' => $g_rank->name
            );
            array_push($g_ranks,$arr);
        }
        return $g_ranks;
    }

    public static function get_net_dkp($user_name){
        $s = DB::selectOne('select * from users where name=?',[$user_name]);
        return $s->dkp_net;
    }

    public static function get_tot_dkp($user_name){
        $s = DB::selectOne('select * from users where name=?',[$user_name]);
        return $s->dkp_tot;
    }

    public static function get_picture($user_name){
        $pic_link = "images/no_user.jpg";
        $s = DB::selectOne('select * from users where name=?',[$user_name]);
        return $s->pic;
    }

    public static function get_faction($user_name){
        $horde = "images/horde.jpg";
        $alliance = "images/alliance.jpg";
        $faction = "";
        $s = DB::selectOne('select * from users where name=?',[$user_name]);
        if(strcmp($s->faction,$horde) == 0 ){
            $faction = "Horde";
        }
        if(strcmp($s->faction,$alliance) == 0 ){
            $faction = "Alliance";
        }
        if(strcmp($s->faction,$alliance) != 0 && strcmp($s->faction,$horde) != 0){
            $faction = "No Faction";
        }
        return $faction;
    }

    

}