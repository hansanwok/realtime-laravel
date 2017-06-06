<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\loaitin;
use App\theloai;

class AjaxController extends Controller
{
    //
    public function getloaitin($idtheloai)
    {
        $loaitin = loaitin::where('idTheLoai', $idtheloai)->get();
        foreach ($loaitin as $row) {
            echo '<option value="' . $row->id . '">' . $row->Ten . '</option>';
        }
    }
}
