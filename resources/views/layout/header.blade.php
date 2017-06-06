<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Laravel Tin Tức</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="about">Giới thiệu</a>
                </li>
                <li>
                    <a href="contact">Liên hệ</a>
                </li>
            </ul>

            <form class="navbar-form navbar-left" role="search" action="search" method="get">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="key">
                </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button type="submit" class="btn btn-default">Submit</button>
            </form>

            <ul class="nav navbar-nav pull-right">
                @if(Auth::User())
                    <li>
                        <a href="taikhoan">
                            <span class="glyphicon glyphicon-user"></span>
                            {{Auth::User()->name}}
                        </a>
                    </li>

                    <li>
                        <a href="dangxuat">Đăng xuất</a>
                    </li>
                @else
                    <li>
                        <a href="dangky">Đăng ký</a>
                    </li>
                    <li>
                        <a href="dangnhap">Đăng nhập</a>
                    </li>
                    <li style="background-color: #3c589f; color:white; display: inline-block">
                        <img src="upload/slide/fb.png" style="float: left; width: 30px; height: 30px; margin-top:8%">
                        <a href="{{url('facebook/redirect')}}">Đăng nhập bằng FB</a>
                    </li>
                    <li style="background-color: #d94e47; color:white; display: inline-block">
                        <img src="upload/slide/gg.png" style="float: left; width: 30px; height: 30px; margin-top:8%">
                        <a href="{{url('google/redirect')}}">Đăng nhập bằng Google</a>
                    </li>
                @endif
            </ul>
        </div>


        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>