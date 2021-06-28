<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class MyAccountController extends Controller
{
    private $profile;
    private $characters;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function my_account(){
        $username = Auth::user()->name;
        $user_data = DB::selectOne('select * from users where name=?',[$username]);
        $this->profile = array(
            'username'          => ucfirst($username),
            'guild_id'          => $user_data->guild_id,
            'rank_color'        => AccountData::get_user_color($user_data->id),
            'rank_name'         => AccountData::get_user_rank($user_data->id),
            'guild_rank_color'  => AccountData::get_guild_rank_color($user_data->guild_rank,$user_data->guild_id),
            'guild_rank_name'   => AccountData::get_guild_rank_name($user_data->guild_rank,$user_data->guild_id),
            'guild_name'        => AccountData::find_guild_name($user_data->guild_id),
            'created_at'        => AccountData::time_ago($user_data->created_at),
            'is_banned'         => AccountData::is_banned($user_data->id),
            'ban_reason'        => AccountData::ban_reason($user_data->id),
            'has_warning'       => AccountData::has_warnings($user_data->id),
            'picture'           => $user_data->pic,
            'banner'            => $user_data->faction,
            'email_verified'    => $user_data->email_verified_at,
            'dkp_net'           => $user_data->dkp_net,
            'dkp_tot'           => $user_data->dkp_tot,
            'user_id'           => $user_data->id
        );
        
        $chars = DB::select('select * from characters where owner_id=? and guild=?',[$user_data->id,$user_data->guild_id,]);
        $this->characters = array();
        foreach($chars as $char){
            $gname = AccountData::find_guild_name($char->guild);
            $grank = AccountData::get_guild_rank_name($char->rank,$char->guild);
            $chars_arr = array(
                'name'      => $char->name,
                'guild_name'=> $gname,
                'race'      => $char->race,
                'class'     => $char->class,
                'rank'      => $grank,
                'ms'        => $char->ms,
                'ms_gs'     => $char->ms_gs,
                'os'        => $char->os,
                'os_gs'     => $char->os_gs,
                'armory'    => $char->armory,
                'char_id'   => $char->id
            );
            array_push($this->characters,$chars_arr);
        }
        return view('user.my_acc',[
            'profile'       => $this->profile,
            'characters'    => $this->characters
        ]);

        
    }

}
