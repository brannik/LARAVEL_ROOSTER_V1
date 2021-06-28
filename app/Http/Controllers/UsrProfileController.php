<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AccountData;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Permission;

class UsrProfileController extends Controller
{
    private $profile;
    private $characters;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function view_profile(Request $request){
        $username = $request->get('username');
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
        return view('profile',[
            'profile'       => $this->profile,
            'characters'    => $this->characters
        ]);
    }

    public function rate_user(Request $request){
        $vote = $request->get('vote');
        $to_user = $request->get('target');
        $from_user = $request->get('sender');

        DB::table('rates')->insert([
            'from_user' => $from_user,
            'to_user'   => $to_user,
            'type'      => $vote
        ]);

        $s = DB::selectOne('select * from users where id=?',[$to_user]);
        $s_s = DB::selectOne('select * from users where id=?',[$from_user]);
        $old_points = $s->comunity_points;
        $sender_old_points = $s_s->comunity_points; 
        $modifier = 0;
        $my_modifier = 0; // mod voters rate also :)
        if(strcmp($vote,"up") == 0){
            $modifier = Permission::get_points('vote_account_up');
            $my_modifier = Permission::get_points('vote_account_up_me');
        }else{
            $modifier = Permission::get_points('vote_account_down');
            $my_modifier = Permission::get_points('vote_account_down_me');   
        }

        if(($old_points + $modifier) >= 0){
            DB::table('users')
                  ->where('id', $to_user)
                ->update(['comunity_points' => $old_points + $modifier]);
        }

        DB::table('users')
                  ->where('id', $from_user)
                ->update(['comunity_points' => $sender_old_points + $my_modifier]);

        return redirect()->back();
    }

    public function send_message(Request $request){
        $this->validate($request,[
            'message_title' => 'required|min:3',
            'message_text'  => 'required|min:5',
            'user_id'       => 'required'
        ]);

        DB::table('mailbox')->insert([
            'sender'    => Auth::user()->id,
            'reciever'  => $request->get('user_id'),
            'is_system' => 0,
            'title'     => $request->get('message_title'),
            'text'      => $request->get('message_text'),
            'token'     => strtoupper(AccountData::generate_token(14))
        ]);

        return redirect()->back();
    }

}
