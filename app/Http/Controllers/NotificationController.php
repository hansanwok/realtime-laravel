<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
class NotificationController extends Controller
{
    var $pusher;
    var $user;
    var $chatChannel;

    const DEFAULT_CHAT_CHANNEL = 'notifications';

    public function __construct()
    {
        $this->pusher = App::make('pusher');
      //  $this->user = Auth::User();
        $this->chatChannel = self::DEFAULT_CHAT_CHANNEL;
    }

    public function getIndex()
    {
        return view('notification',['chatChannel' => $this->chatChannel]);
    }

    public function postNotify(Request $request)
    {
        $notifyText = e($request->input('notify_text'));
        $this->pusher->trigger($this->chatChannel, 'new-notification', $notifyText);
    }
}
