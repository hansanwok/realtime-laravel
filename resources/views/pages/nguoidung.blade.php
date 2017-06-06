@extends('layout.index')
@section('title')
    {{Auth::user()->name}}
@endsection
@section('content')
    <div class="container">

        <!-- slider -->
        <div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <!-- thong bao flash-->
                <!-- kiem tra xem nhap co loi hay ko -->
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $row)
                            {{$row}} <br>
                        @endforeach
                    </div>
                @endif
                @if(session('thongbao') != '')
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">Thông tin tài khoản</div>
                    <div class="panel-body">
                        <form method="post" action="taikhoan">
                            <div>
                                <label>Họ tên</label>
                                <input type="text" value="{{Auth::user()->name}}" class="form-control"
                                       placeholder="Username" name="name" aria-describedby="basic-addon1">
                            </div>
                            <br>
                            <div>
                                <label>Email</label>
                                <input type="email" value="{{Auth::user()->email}}" class="form-control"
                                       placeholder="Email" name="email" aria-describedby="basic-addon1"
                                       disabled
                                >
                            </div>
                            <br>
                            <div>
                                <input type="checkbox" id="changePassword" name="checkpassword">
                                <label>Đổi mật khẩu</label>
                                <input type="password" class="form-control password" name="password"
                                       aria-describedby="basic-addon1" disabled>
                            </div>
                            <br>
                            <div>
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control password" name="passwordAgain"
                                       aria-describedby="basic-addon1" disabled>
                            </div>
                            <br>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <button type="submit" class="btn btn-default">Sửa
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

@section('script')
    <script>
        $(document).ready(function () {
            $("#changePassword").change(function () {
                if ($(this).is(":checked")) {
                    $(".password").removeAttr('disabled');
                }
                else {
                    $(".password").attr('disabled', '');
                }
            });
        });
    </script>
@endsection