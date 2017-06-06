@extends('layout.index')
@section('title')
    {{'Dang Ky'}}
@endsection
@section('content')
    <div class="container">

        <!-- slider -->
        <div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <!-- kiem tra xem nhap co loi hay ko -->
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $row)
                            {{$row}} <br>
                        @endforeach
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">Đăng ký tài khoản</div>
                    <div class="panel-body">
                        <form action="dangky" method="post">
                            <div>
                                <label>Họ tên</label>
                                <input type="text" class="form-control" placeholder="Username" name="name"
                                       aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <div>
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="email"
                                       aria-describedby="basic-addon1"
                                >
                            </div>
                            <br>
                            <div>
                                <input type="password" class="form-control" name="password"
                                       aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <div>
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" name="re_password"
                                       aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <button type="submit" class="btn btn-default">Đăng ký
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
@endsection