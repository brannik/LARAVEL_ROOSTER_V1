<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Events\MessageSentEvent;
use SebastianBergmann\CodeCoverage\StaticAnalysis\Cache;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return Message::with('user')->get();
    }

    public function store(Request $request){
        $user = Auth::user();

    // error ???
        $message = $user->messages()->create([
            'message' => $request->get('message')
        ]);


    // send event to listeners
        broadcast(new MessageSentEvent($message, $user))->toOthers();

        return [
            'message' => $message,
            'user' => $user,
        ];
    }
}