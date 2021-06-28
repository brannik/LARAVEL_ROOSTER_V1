<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AccountData;

class HomeController extends Controller
{
    private $posts_arr;
    private $pages_count;
    public function __construct()
    {

        $this->middleware('auth');
        $query_get = DB::select('select * from news order by important DESC, date desc');
        $this->pages_count = count($query_get) / 4;
        $this->posts_arr = array();
        $inner_arr = array();
        foreach($query_get as $news){
            $inner_arr = array(
                'category_title'    => $news->title,
                'category_id'       => $news->id,
                'category_author'   => AccountData::get_username($news->author_id),
                'author_id'         => $news->author_id,
                'category_sample'   => $news->text,
                'token'             => $news->token,
                'important'         => $news->important,
                'author_color'      => AccountData::get_user_color($news->author_id),
                'rank_name'         => AccountData::get_user_rank($news->author_id),
                'time'              => AccountData::time_ago($news->date),
                'author_banned'     => AccountData::is_banned($news->author_id),
                'user_pic'          => AccountData::get_user_pic($news->author_id)
            );
            array_push($this->posts_arr,$inner_arr);
                
        }    
        
    }
    public function index()
    {
        $current_page = 1;
        $offset = 4;
        $on_this_page = array();
        $begin = ($current_page - 1) * $offset;
        $end = ($offset * $current_page);
        if(!isset($this->posts_arr[$end])){
            $end = count($this->posts_arr);
        }
        for($i=$begin;$i<$end;$i++){
            array_push($on_this_page,[
                'category_title'    => $this->posts_arr[$i]['category_title'],
                'category_id'       => $this->posts_arr[$i]['category_id'],
                'category_author'   => $this->posts_arr[$i]['category_author'],
                'author_id'         => $this->posts_arr[$i]['author_id'],
                'category_sample'   => $this->posts_arr[$i]['category_sample'],
                'token'             => $this->posts_arr[$i]['token'],
                'important'         => $this->posts_arr[$i]['important'],
                'author_color'      => $this->posts_arr[$i]['author_color'],
                'rank_name'         => $this->posts_arr[$i]['rank_name'],
                'time'              => $this->posts_arr[$i]['time'],
                'author_banned'     => $this->posts_arr[$i]['author_banned'],
                'user_pic'          => $this->posts_arr[$i]['user_pic']
            ]);
        }
        return view('home',[
            'data'      => $on_this_page,
            'pages'     => $this->pages_count,
            'curr_page' => 1,
            'reqruiter' => AccountData::is_rqruiter(Auth::user()->guild_d)
        ]);
        print_r($this->posts_arr);
    }

    public function view_home_page(Request $request){
        // get news for only this page
        $current_page = $request->get('page');
        $offset = 4;
        $begin = ($current_page - 1) * $offset;
        $end = ($offset * $current_page);
        if(!isset($this->posts_arr[$end])){
            $end = count($this->posts_arr);
        }
        $on_this_page = array();
        for($i=$begin;$i<$end;$i++){
            array_push($on_this_page,[
                'category_title'    => $this->posts_arr[$i]['category_title'],
                'category_id'       => $this->posts_arr[$i]['category_id'],
                'category_author'   => $this->posts_arr[$i]['category_author'],     
                'author_id'         => $this->posts_arr[$i]['author_id'],
                'category_sample'   => $this->posts_arr[$i]['category_sample'],
                'token'             => $this->posts_arr[$i]['token'],
                'important'         => $this->posts_arr[$i]['important'],
                'author_color'      => $this->posts_arr[$i]['author_color'],
                'rank_name'         => $this->posts_arr[$i]['rank_name'],
                'time'              => $this->posts_arr[$i]['time'],
                'author_banned'     => $this->posts_arr[$i]['author_banned'],
                'user_pic'          => $this->posts_arr[$i]['user_pic']
            ]);
        }
        return view('home',[
            'data'      => $on_this_page,
            'pages'     => $this->pages_count,
            'curr_page' => $current_page,
            'reqruiter' => AccountData::is_rqruiter(Auth::user()->guild_d)
        ]);
        error_log(implode($on_this_page));
    }

    public function new_post(Request $request){
        $this->validate($request,[
            'post_text'     => 'required|min:10',
            'post_title'    => 'required|min:4'
        ]);
        $my_id = Auth::user()->id;
        $important = $request->get('check_important');
        $important_bool = 0;
        if(strcmp($important,'on') == 0) $important_bool = 1;
        DB::table('news')->insert([
            [
                'author_id' => $my_id,
                'title'     => $request->get('post_title'),
                'text'      => $request->get('post_text'),
                'important' => $important_bool,
                'token'     => strtoupper(AccountData::generate_token(10))
            ]
            ]);
            return redirect()->back();
    }

    public function edit_post(Request $request){
        $this->validate($request,[
            'token'     => 'required',
            'post_text' => 'required|min:10',
            'post_title'=> 'required|min:4'
        ]);

        $important = $request->get('important_state');
        $important_bool = 0;
        if(strcmp($important,'on') == 0) $important_bool = 1;

        DB::table('news')
              ->where('token', $request->get('token'))
              ->update([
                  'text'        => $request->get('post_text'),
                  'title'       => $request->get('post_title'),
                  'important'   => $important_bool
                ]);
        return redirect()->back();
    }

    public function delete_post(Request $request){
        $this->validate($request,[
            'token'     => 'required'
        ]);
        DB::table('news')->where('token', '=', $request->get('token'))->delete();
        return redirect()->back();
    }
    
}
