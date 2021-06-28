<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AccountData;

class MailboxController extends Controller
{
    private $messages;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function mailbox(){
        $my_id = Auth::user()->id;
        $this->messages = array();
        $m = DB::select('select * from mailbox where reciever=? order by is_system DESC , is_read ASC',[$my_id]);
        foreach($m as $message){
            $u = DB::selectOne('select * from users where id=?',[$message->sender]);
            
            $msg = array(
                'id'        => $message->id,
                'token'     => $message->token,
                'sender_id' => $message->sender,
                'from'      => $u->name,
                'title'     => $message->title,
                'text'      => $message->text,
                'is_read'   => $message->is_read,
                'is_system' => $message->is_system,
                'date'      => AccountData::time_ago($message->date)
            );
            array_push($this->messages,$msg);
        }
        return view('user.mailbox',[
            'messages' => $this->messages
        ]);
    }

}
