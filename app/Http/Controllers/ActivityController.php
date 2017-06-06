<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Socialite;

class ActivityController extends Controller
{
    var $pusher;
    var $user;

    public function __construct()
    {
        $this->pusher = App::make('pusher');
        $this->user =  Auth::User();
    }

    /**
     * Serve the example activities view
     */
    public function getIndex()
    {
        // If there is no user, redirect to GitHub login
        if(!Auth::User())
        {
            return redirect('facebook/redirect');
        }

        // TODO: provide some useful text
        $activity = [
            'text' => Auth::User()->name.' has visited the page',
            'username' => Auth::User()->name,
            'id' => Auth::User()->id,
            'avatar' => Auth::User()->avt,
        ];
        $this->pusher->trigger('activities', 'user-visit', $activity);
        // TODO: trigger event
        // sai khi chay thi no lai return, thi se hien ra lai mat nhu trang ban dau,
        // chi con cach luu vao database roi tro ra view
        return view('activities');
    }
    /**
     * A new status update has been posted
     * @param Request $request
     */
    public function postStatusUpdate(Request $request)
    {
        $statusText = e($request->input('status_text'));

        // TODO: trigger event
    }

    /**
     * Like an exiting activity
     * @param $id The ID of the activity that has been liked
     */
    public function postLike($id)
    {
        // TODO: trigger event
        if(!Auth::User())
        {
            return redirect('facebook/redirect');
        }

        $activity = [
            'text' => Auth::User()->name.' has visited the page',
            'username' => Auth::User()->name,
            'id' => Auth::User()->id,
            'avatar' => Auth::User()->avt,
            'likedActivityId' => $id,
        ];
        $this->pusher->trigger('activities', 'like', $activity);

    }
}
