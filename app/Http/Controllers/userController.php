<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\MessageBag;
use Validator;

class userController extends Controller
{
//
    public function get_login()
    {
        return view('admin.login');
    }

    public function post_login(Request $request)
    {
        $rule = [
            'ten' => 'required',
            'password' => 'required'
        ];
        $message = [
            'ten.required' => 'Nhap ten',
            'password.required' => 'nhap mat khau chua'
        ];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ], 200);
            // return redirect('admin/login')->with('thongbao','Sai mat khua hoac tai khoan');
        } else {
            if (Auth::attempt(['name' => $request->input('ten'), 'password' => $request->input('password')]))
            {
                return response()->json([
                    'error' => false,
                    'message' => 'success'
                ], 200);
            }
            else {
                $errors = new MessageBag(['thongbao' => 'Sai mat khau hoac tai khoan']);
                return response()->json([
                    'error' => true,
                    'message' => $errors
                ], 200);
            }
            //return redirect('admin/theloai/list');
        }
    }


    public
    function get_logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }

    public
    function getList()
    {
        $user = User::all();
        return view('admin.user.list', ['user' => $user]);
    }

    public
    function get_add()
    {
        return view('admin.user.add');
    }

    public
    function post_add(Request $request)
    {
        $this->validate($request,
            ['name' => 'required|min:3|max:50|unique:users,name',
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
        $user->quyen = $request->quyen;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('admin/user/list')->with('thongbao', 'them thanh cong');
    }

    public
    function get_edit($id)
    {
        $user = user::find($id);

        return view('admin.user.edit', ['user' => $user]);
    }

    public
    function post_edit(Request $request, $id)
    {
        $user = user::find($id);

        $this->validate($request,
            ['name' => 'required|min:3|max:50|unique:users,name',
            ],
            [
                'Ten.required' => 'Nhap ten the loai',
                'Ten.min' => 'do dai 3->50',
                'Ten.max' => 'do dai 3->50',
                'Ten.unique' => 'Ten da ton tai'
            ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != '') {
            $this->validate($request,
                ['password' => 'required',
                    're_password' => 'required|same:password'],
                []);
            $user->password = bcrypt($request->password);
        }
        $user->quyen = $request->quyen;
        $user->save();
        return redirect('admin/user/list')->with('thongbao', 'sua thanh cong');
    }

    public function get_delete($id)
    {
        $user = user::find($id);
        $user->delete();
        return redirect('admin/user/list')->with('thongbao', 'xoa thanh cong');
    }

}
