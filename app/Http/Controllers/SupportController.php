<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportController extends Controller
{
    public $posts_arr;
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function support()
    {
        $this->posts_arr = array(
            [
            'post_author'   => 'Someone',
            'post_text'     => 'Some text'
            ],
            [
                'post_author'   => 'Someone else',
                'post_text'     => 'Some text from it'
            ]
        );
        return view('support',[
            'data' => $this->posts_arr
        ]);
    }
}
