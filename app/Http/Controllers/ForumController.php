<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumController extends Controller
{
    private $forum_category;
    private $pages_count;
    public function __construct()
    {
        $this->middleware('auth');
        // get these from db
        $this->forum_category = array(
            [
                [
                    'posts_count'   => 10,
                    'author'        => 'Brannik',
                    'title'         => 'Class Guides',
                    'short_text'    => 'short description'
                ],
                [
                    'posts_count'   => 1,
                    'author'        => 'Brannik',
                    'title'         => 'Raid Guides',
                    'short_text'    => 'short description 2'
                ],
                [
                    'posts_count'   => 3,
                    'author'        => 'Brannik',
                    'title'         => 'Junk',
                    'short_text'    => 'short description 3'
                ],
                [
                    'posts_count'   => 3,
                    'author'        => 'Brannik',
                    'title'         => 'Some category',
                    'short_text'    => 'short description 3'
                ]
            ],
            [
                [
                    'posts_count'   => 10,
                    'author'        => 'Brannik',
                    'title'         => 'P2 Class Guides',
                    'short_text'    => 'short description'
                ],
                [
                    'posts_count'   => 1,
                    'author'        => 'Brannik',
                    'title'         => 'P2 Raid Guides',
                    'short_text'    => 'short description 2'
                ],
                [
                    'posts_count'   => 3,
                    'author'        => 'Brannik',
                    'title'         => 'P2 Junk',
                    'short_text'    => 'short description 3'
                ],
                [
                    'posts_count'   => 3,
                    'author'        => 'Brannik',
                    'title'         => 'P2 Some category',
                    'short_text'    => 'short description 3'
                ]
            ]
        );
        $count = 0;
        foreach($this->forum_category as $post){
            $count = $count + 1;
        }
        $this->pages_count = $count;
    }

    
    public function forum()
    {
        // build arrays and display 1-st page
        
        $on_this_page = array();
        foreach($this->forum_category[0] as $forum_category){
            array_push($on_this_page,[
                'posts_count'   => $forum_category['posts_count'],
                'author'        => $forum_category['author'],
                'title'         => $forum_category['title'],
                'short_text'    => $forum_category['short_text']
            ]);
        }
        return view('forum.forum_main',[
            'category'  => $on_this_page,
            'pages'     => $this->pages_count,
            'curr_page' => 1
        ]);
    }

    public function view_forum_page(Request $request){
        $current_page = $request->get('page');
        $on_this_page = array();
        foreach($this->forum_category[$current_page - 1] as $forum_category){
            array_push($on_this_page,[
                'posts_count'   => $forum_category['posts_count'],
                'author'        => $forum_category['author'],
                'title'         => $forum_category['title'],
                'short_text'    => $forum_category['short_text']
            ]);
        }
        return view('forum.forum_main',[
            'category'  => $on_this_page,
            'pages'     => $this->pages_count,
            'curr_page' => $current_page
        ]);
    }

    public function view_category_page(Request $request){
        // display selected category
    }

    public function view_post_page(Request $request){
        // display selected post and his comments
    }
}
