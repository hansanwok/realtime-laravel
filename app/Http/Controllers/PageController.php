<?php

namespace App\Http\Controllers;

use App\comment;
use Illuminate\Http\Request;
use App\theloai;
use App\slide;
use App\loaitin;
use App\tintuc;
use Illuminate\Support\Facades\Auth;
use App\User;
use Mail;
class PageController extends Controller
{
    //
    var $email;
    function __construct()
    {
        $theloai = theloai::all();
        $slide = slide::all();
        view()->share('slide', $slide);
        view()->share('theloai', $theloai);
        if (Auth::check()) {
            view()->share('member', Auth::user());
        }
    }

    public function home()
    {

        return view('pages.home');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function loaitin($id)
    {
        $loaitin = loaitin::find($id);
        $tintuc = tintuc::where('idLoaiTin', $id)->paginate(5);
        return view('pages.loaitin', ['loaitin' => $loaitin, 'tintuc' => $tintuc]);
    }

    public function tintuc($id)
    {
        $tintuc = tintuc::find($id);
        $tinnoibat = tintuc::where('NoiBat', 1)->take(4)->get();
        $tinlienquan = tintuc::where('idLoaiTin', $tintuc->idLoaiTin)->take(4)->get();
        $comment = comment::where('idTinTuc', $id)->orderBy('id', 'DESC')->get();
        return view('pages.detail', ['tintuc' => $tintuc
            , 'tinnoibat' => $tinnoibat,
            'tinlienquan' => $tinlienquan,
            'comment' => $comment
        ]);
    }

    public function get_dangnhap()
    {
        return view('pages.dangnhap');
    }

    public function post_dangnhap(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Nhap ten',
            'password.required' => 'nhap mat khau chua'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/');
        } else {
            return redirect('dangnhap')->with('thongbao', 'Sai mat khua hoac tai khoan');
        }
    }

    public function dangxuat()
    {
        Auth::logout();
        return redirect('/');
    }

    public function get_taikhoan()
    {
        if (Auth::User()) {
            return view('pages.nguoidung');
        } else
            return redirect('/');
    }

    public function post_taikhoan(Request $request)
    {
        $user = Auth::User();

        $this->validate($request,
            ['name' => 'required|min:3|max:50',
            ],
            [
                'name.required' => 'Nhap ten the loai',
                'name.min' => 'do dai 3->50',
                'name.max' => 'do dai 3->50',
            ]);
        $user->name = $request->name;
        if ($request->password != '') {
            $this->validate($request,
                ['password' => 'required',
                    're_password' => 'required|same:password'],
                []);
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect('taikhoan')->with('thongbao', 'sua thanh cong');
    }

    public function get_dangky()
    {
        return view('pages.dangky');
    }

    public function post_dangky(Request $request)
    {
        $this->validate($request,
            ['email' => 'required|min:3|max:50|unique:users,email',
                'name' => 'required',
                'password' => 'required',
                're_password' => 'required|same:password'
            ],
            [
                'Ten.required' => 'Nhap ten the loai',
                'Ten.min' => 'do dai 3->50',
                'Ten.max' => 'do dai 3->50',
                'Ten.unique' => 'Ten da ton tai'
            ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $this->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        // gui mail
        Mail::send('pages.dangnhap', array('name'=>$request->name,'email'=>$request->email, 'content'=>'Dang Ki Thanh Cong tren trang trungbieupro.tk'), function($message){
            $message->to($this->email, 'Visitor')->subject('Visitor Feedback!');
        });
        return redirect('dangnhap')->with('thongbao', 'dang ki thanh cong chúng tôi đã gửi cho bạn 1 email xác thực, mở gmail đã đăng kí của bạn lên để hoàn tất');
    }

    public function search(Request $request)
    {
        $key = $request->key;
        $tintuc = tintuc::where('TieuDe', 'like', "%$key%")->orWhere('TomTat', 'like', "%$key%")->orWhere('NoiDung', 'like', "%$key%");
        $dem = $tintuc->count();
        $tintuc = tintuc::where('TieuDe', 'like', "%$key%")->orWhere('TomTat', 'like', "%$key%")->orWhere('NoiDung', 'like', "%$key%")->take(30)->paginate(5)->appends(['key' => $key]);
        return view('pages.search', ['tintuc' => $tintuc, 'key' => $key, 'dem' => $dem]);
    }
}
