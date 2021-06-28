<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuildController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function gcp(){
        return view('guild.guild_cp',['value' => 'guild master or site admin access']);
    }

}
