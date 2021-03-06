<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\chat;
use Illuminate\Support\Facades\Input;
class ChatController extends Controller
{
    //
    var $pusher;
    var $user;
    var $chatChannel;

    const DEFAULT_CHAT_CHANNEL = 'chat';

    public function __construct()
    {
        $this->pusher = App::make('pusher');
        $this->user = Auth::User();
        $this->chatChannel = self::DEFAULT_CHAT_CHANNEL;
    }
    public function getIndex()
    {
        if(!Auth::User())
        {
            return redirect('google/redirect');
        }
        //get 4 last chat
        $last = chat::all()->sortByDesc('id')->take(3);
        return view('chat',['chatChannel' => $this->chatChannel,'last'=>$last]);
    }

    public function postMessage(Request $request)
    {
        $message = [
            'text' => e($request->input('chat_text')),
            'username' => Auth::User()->name,
            'id' => Auth::User()->id,
            'avatar' => Auth::User()->avt,
            'timestamp' => (time()*1000)
        ];
        $this->pusher->trigger($this->chatChannel, 'new-message', $message);
        //save to database
        $chat = new chat();
        $chat->idUser = Auth::User()->id;
        $chat->text = $message['text'];
        $chat->save();
    }
}
