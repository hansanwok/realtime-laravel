@extends('layout.index')
@section('title')
    {{$tintuc->TieuDe}}
@endsection
@section('content')
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>    {{$tintuc->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Admin</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{$tintuc->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">
                    {!! $tintuc->NoiDung !!}
                </p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form role="form" method="post" action="comment/{{$tintuc->id}}">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="NoiDung"></textarea>
                        </div>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                @if(count($comment)>0)
                    @foreach($comment as $row)
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$row->user->name}}
                                    <small>{{$row->created_at}}</small>
                                </h4>
                                {{$row->NoiDung}}
                            </div>
                            <!--kiem tra xem commnent co phai cua user do binh luan ko (ton tai user dang nhap) -->
                            @if(Auth::User())
                                @if($row->user->id == Auth::User()->id)
                                    <a style="float:right; text-decoration: underline"
                                       href="get_del/{{$row->id}}}">Delete</a>
                                @endif
                            @endif
                        </div>
                @endforeach
            @endif

            <!-- Comment -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">
                    @foreach($tinlienquan as $row)
                        <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="tintuc/{{$row->id}}/{{$row->TieuDeKhongDau}}.html">
                                        <img class="img-responsive" src="upload/tintuc/{{$row->Hinh}}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="tintuc/{{$row->id}}/{{$row->TieuDeKhongDau}}.html"><b>{{$row->TieuDe}}</b></a>
                                </div>
                                <p style="padding-left:5px;">{{substr($row->TomTat,0,110)}}...</p>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                    @foreach($tinnoibat as $row)
                        <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="tintuc/{{$row->id}}/{{$row->TieuDeKhongDau}}.html">
                                        <img class="img-responsive" src="upload/tintuc/{{$row->Hinh}}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="tintuc/{{$row->id}}/{{$row->TieuDeKhongDau}}.html"><b>{{$row->TieuDe}}</b></a>
                                </div>
                                <p style="padding-left:5px;">{{substr($row->TomTat,0,110)}}...</p>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->
    </div>
@endsection