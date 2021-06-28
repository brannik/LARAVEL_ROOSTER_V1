<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModeratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function moderator(){
        return view('moderator.moderator',['value' => 'mod panel']);
    }

}
