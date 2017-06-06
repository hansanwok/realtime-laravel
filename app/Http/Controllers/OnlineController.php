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
// noi chung la lam ntn se ko on, chi de test thoi, dung ra khi nta dang nhap thi goi toi pusher luon r, chi de ntn moi
//lan refresh no lai tinh 1 lan
class OnlineController extends Controller
{
    //
    var $pusher;
    var $user;
    var $Channel;

    const DEFAULT_CHAT_CHANNEL = 'presence-online';
    public function __construct()
    {
        $this->pusher = App::make('pusher');
        $this->user = Auth::User();
        $this->Channel = self::DEFAULT_CHAT_CHANNEL;
    }
    public function index()
    {
        if(!Auth::User())
        {
            return redirect('google/redirect');
        }
        return view('online',['Channel' => $this->Channel]);
    }
    public function endpoint()
    {
        $member = [
            'username' => Auth::User()->name,
            'id' => Auth::User()->id,
            'avatar' => Auth::User()->avt
        ];
        echo $this->pusher->presence_auth($this->Channel, $_POST["socket_id"],$member['id'],$member);
    }
}
