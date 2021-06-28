<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\guild_chat;
use App\Http\Controllers\AccountData;

class SupportAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function supp_admin(){
        //DB::insert('insert into guild_chat (sender,message) values(?,?)',['Brannik','Some random text' . AccountData::generate_token(20)]);
        return view('moderator.support_mod',['value' => 'Admin moderator panel']);
    }

}
