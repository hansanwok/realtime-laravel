@extends('layout.index')
@section('title')
    {{'Dang Nhap'}}
@endsection
@section('content')
    <div class="container">

        <!-- slider -->
        <!-- kiem tra xem nhap co loi hay ko -->
        @if(count($errors)>0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $row)
                    {{$row}} <br>
                @endforeach
            </div>
        @endif
    <!-- thong bao flash-->
        @if(session('thongbao') != '')
            <div class="alert alert-success">
                {{session('thongbao')}}
            </div>
        @endif
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Đăng nhập</div>
                    <div class="panel-body">
                        <form method="post" action="dangnhap">
                            <div>
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="email"
                                >
                            </div>
                            <br>
                            <div>
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <br>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <button type="submit" class="btn btn-default">Đăng nhập
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <!-- end slide -->
    </div>
@endsection