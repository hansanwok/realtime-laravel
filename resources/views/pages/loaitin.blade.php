@extends('layout.index')
@section('title')
    {{$loaitin->Ten}}
@endsection()
@section('content')
    <div class="container">
        <div class="row">
            @include('layout.menu')

            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>{{$loaitin->Ten}}</b></h4>
                    </div>
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
                                <h3>{{$row->TieuDe}}</h3>
                                <p>{{$row->TomTat}}</p>
                                <a class="btn btn-primary" href="tintuc/{{$row->id}}/{{$row->TieuDeKhongDau}}.html">More <span
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
            </div>

        </div>

    </div>
@endsection