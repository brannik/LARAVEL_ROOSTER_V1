<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdministratorController extends Controller
{
    private $accounts;
    private function collect_data(){
        $s = DB::select('select * from users order by name ASC');
        $this->accounts = array();
        foreach($s as $account){
            $arr = array(
                'username'          => $account->name,
                'user_id'           => $account->id,
                'token'             => strtoupper($this->generate_token(10)), // support switching between tabs
                'guild_id'          => $account->guild_id,
                'g_rank_id'         => $account->guild_rank,
                'email_verified'    => $account->email_verified_at,
                'banned'            => $account->banned,
                'comunity_points'   => $account->comunity_points
            );
            array_push($this->accounts,$arr);
        }
    }
    public function __construct()
    {
        $this->middleware('auth');
        $this->collect_data();
    }
    public function acp(){
        
        return view('admin.admin',[
            'value'     => 'ADMIN PANEL',
            'accounts'  => $this->accounts
        ]);
    }

    private function generate_token($length = 10) {
        return substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    public function save_profile(Request $request){
        $this->validate($request,[
            'new_faction'       => 'required',
            'new_username'      => 'nullable|min:5',
            'new_net_dkp'       => 'required',
            'new_tot_dkp'       => 'required',
            'user_id_to_edit'   => 'required'
        ]);

        $old_data = DB::selectOne('select * from users where id=?',[$request->get('user_id_to_edit')]);
        $username = $old_data->name;
        $faction = $old_data->faction;
        $rank = $old_data->rank;
        $grank = $old_data->guild_rank;
        $guild = $old_data->guild_id;

        //check for new data
        if(!empty($request->get('new_username'))){
            if(strcmp($request->get('new_username'),$username) != 0){
                $username = $request->get('new_username');
            }
        }

        if(strcmp($faction,$request->get('new_faction')) != 0){
            switch($request->get('new_faction')){
                case 'Alliance':
                    $faction = "images/alliance.jpg";
                    break;
                case 'Horde':
                    $faction = "images/horde.jpg";
                    break;
                case 'No Faction':
                    $faction = "images/banner.jpg";
                    break;
            }
        }

        $g = DB::selectOne('select * from guild where id=?',[$guild]);
        if(strcmp($g->name,$request->get('new_guild')) != 0){
            $ng = DB::selectOne('select * from guild where name=?',[$request->get('new_guild')]);
            $guild = $ng->id;
        }

        $g_r = DB::selectOne('select * from guild_ranks where id=? and guild_id=?',[$grank,$guild]);
        if(strcmp($g_r->name,$request->get('new_rank')) != 0){
            $n_gr = DB::selectOne('select * from guild_ranks where guild_id=? and name=?',[$guild,$request->get('new_rank')]);
            $grank = $n_gr->id;
        }

        $wr = DB::selectOne('select * from web_ranks where id=?',[$rank]);
        if(strcmp($wr->rank_name,$request->get('new_rank_web')) != 0){
            $nwr = DB::selectOne('select * from web_ranks where rank_name=?',[$request->get('new_rank_web')]);
            $rank = $nwr->id;
        }

        DB::table('users')
              ->where('id', $request->get('user_id_to_edit'))
              ->update([
                  'name'        => $username,
                  'faction'     => $faction,
                  'rank'        => $rank,
                  'guild_rank'  => $grank,
                  'guild_id'    => $guild,
                  'dkp_net'     => $request->get('new_net_dkp'),
                  'dkp_tot'     => $request->get('new_tot_dkp')
                ]);
        
        $this->collect_data();
        return view('admin.admin',[
            'value'     => 'ADMIN PANEL',
            'accounts'  => $this->accounts
        ]);
    }

    public function unban(Request $request){
        DB::table('users')
              ->where('id', $request->get('user_id'))
              ->update(['banned' => 0 ,'ban_reason' => 'NO W']);

        return redirect()->back();
    }

    public function save_settings(Request $request){
        echo $request->get('option');
        echo "<br>";
        echo $request->get('min_rank');
        echo "<br>";
        echo $request->get('points_value');
        DB::table('settings')
            ->where('action',$request->get('option'))
            ->update(['value' => $request->get('points_value')]);
        $rnk_id = DB::selectOne('select * from web_ranks where rank_name=?',[$request->get('min_rank')]);
        DB::table('settings_permission')
            ->where('option',$request->get('option_id'))
            ->update(['web_rank' => $rnk_id->id]);

            return redirect()->back();
    }

}
