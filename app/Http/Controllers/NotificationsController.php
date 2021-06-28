<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function notifications(){
        return view('user.notifications',['value' => 'my notifications page']);
    }

}
