<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class AccountData
{
    public static function get_user_pic($user_id){
        $u = DB::selectOne('select * from users where id=?',[$user_id]);
        return $u->pic;
    }
    public static function get_username($user_id){
        $usr = DB::selectOne('select * from users where id=?',[$user_id]);
        return $usr->name;
    }
    public static function get_user_rank($user_id){
        $usr = DB::selectOne('select * from users where id=?',[$user_id]);
        $rank_d = DB::selectOne('select * from web_ranks where id=?',[$usr->rank]);
        return $rank_d->rank_name;
    }

    public static function get_user_color($user_id){
        $usr = DB::selectOne('select * from users where id=?',[$user_id]);
        $rank_d = DB::selectOne('select * from web_ranks where id=?',[$usr->rank]);
        return $rank_d->rank_color;
    }

    public static function generate_token($length = 10) {
        return substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    public static function get_guild_rank_color($rank_id,$guild_id){
        $color = "badge badge-pill badge-light";
        if($rank_id >= 0){
            $g = DB::selectOne('select * from guild_ranks where id=? and guild_id=?',[$rank_id,$guild_id]);
            $color = $g->color;
        }
        return $color;
    }

    public static function get_guild_rank_name($rank_id,$guild_id){
        $name = "no guild";
        if($rank_id >= 0){
            $g = DB::selectOne('select * from guild_ranks where id=? and guild_id=?',[$rank_id,$guild_id]);
            $name = $g->name;
        }
        return $name;
    }

    public static function is_banned($acc_id){
        $q = DB::selectOne('select * from users where id=?',[$acc_id]);
        return $q->banned;
    }
    
    public static function ban_reason($acc_id){
        $q = DB::selectOne('select * from users where id=?',[$acc_id]);
        return $q->ban_reason;
    }

    public static function has_warnings($acc_id){
        $warn = "none";
        $q = DB::selectOne('select * from users where id=?',[$acc_id]);
        if(strcmp($q->warning,"NO W") != 0){
            $warn = $q->warning;
        }
        return $warn;
    }

    public static function is_rqruiter($guild_id){
        $is_reqruiter = 0;
        if($guild_id > 0){
            $g = DB::selectOne('select * from guild where id=?',[$guild_id]);
            $my_g_rank = Auth::user()->guild_rank;
            if($g->reqruiter_rank <= $my_g_rank){
                $is_reqruiter = 1;
            }
        }
        return $is_reqruiter;
        
    }

    public static function find_guild_name($guild_id){
        $gname = "No guild";
        if($guild_id > 0){
            $guild = DB::selectOne('select * from guild where id=?',[$guild_id]);
            $gname = $guild->name;
        }
        return $gname;
    }

    public static function time_ago($timestamp){
  
        date_default_timezone_set("Europe/Sofia");         
        $time_ago        = strtotime($timestamp);
        $current_time    = time();
        $time_difference = $current_time - $time_ago;
        $seconds         = $time_difference;
        
        $minutes = round($seconds / 60); // value 60 is seconds  
        $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec  
        $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;  
        $weeks   = round($seconds / 604800); // 7*24*60*60;  
        $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60  
        $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60
                      
        if ($seconds <= 60){
      
          return "Just Now";
      
        } else if ($minutes <= 60){
      
          if ($minutes == 1){
      
            return "one minute ago";
      
          } else {
      
            return "$minutes minutes ago";
      
          }
      
        } else if ($hours <= 24){
      
          if ($hours == 1){
      
            return "an hour ago";
      
          } else {
      
            return "$hours hrs ago";
      
          }
      
        } else if ($days <= 7){
      
          if ($days == 1){
      
            return "yesterday";
      
          } else {
      
            return "$days days ago";
      
          }
      
        } else if ($weeks <= 4.3){
      
          if ($weeks == 1){
      
            return "a week ago";
      
          } else {
      
            return "$weeks weeks ago";
      
          }
      
        } else if ($months <= 12){
      
          if ($months == 1){
      
            return "a month ago";
      
          } else {
      
            return "$months months ago";
      
          }
      
        } else {
          
          if ($years == 1){
      
            return "one year ago";
      
          } else {
      
            return "$years years ago";
      
          }
        }
      }

}
