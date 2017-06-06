@extends('layout.index')
@section('title')
    Tìm Kiếm
@endsection()
@section('content')
    <div class="container">
        <div class="row">
            @include('layout.menu')
            <?php
            function changeColor($str, $key)
            {
                return str_replace($key, '<span style="color:yellow">'.$key.'</span>', $str);
            }
            ?>
            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>tìm kiếm với từ khóa : {!! changeColor($key,$key)!!} có {!!changeColor($dem,$dem)!!} kết quả</b></h4>
                    </div>
                    @if($tintuc->count() > 0)
                        @foreach($tintuc as $row)
                            <div class="row-item row">
                                <div class="col-md-3">

                                    <a href="tintuc/{{$row->id}}/{{$row->TieuDeKhongDau}}.html">
                                        <br>
                                        <img width="200px" height="200px" class="img-responsive"
                                             src="upload/tintuc/{{$row->Hinh}}" alt="">
                                    </a>
                                </div>

                                <div class="col-md-9">
                                    <h3> {!!changeColor($row->TieuDe,$key)!!}</h3>
                                    <p> {!!changeColor($row->TomTat,$key)!!}</p>
                                    <a class="btn btn-primary" href="tintuc/{{$row->id}}/{{$row->TieuDeKhongDau}}.html">More
                                        <span
                                                class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                                <div class="break"></div>
                            </div>
                    @endforeach

                    <!-- Pagination -->
                        <div class="row text-center">
                            <div class="col-lg-12">
                                {{$tintuc->links()}}
                            </div>
                        </div>
                        <!-- /.row -->

                </div>
                @else
                    Ko co ket qua tim kiem nao phu hop
                @endif
            </div>

        </div>

    </div>
@endsection