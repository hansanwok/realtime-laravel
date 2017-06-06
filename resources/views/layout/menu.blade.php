<div class="col-md-3 ">
    <ul class="list-group" id="menu">
        <li href="#" class="list-group-item menu1 active">
            Menu
        </li>
        @foreach($theloai as $row)
            <li href="#" class="list-group-item menu1">
                {{$row->Ten}}
            </li>
            @if(count($row->loaitin) > 0)
                <ul>
                    @foreach($row->loaitin as $lt)
                        <li class="list-group-item">
                            <a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html">{{$lt->Ten}}</a>
                        </li>
                    @endforeach
                </ul>
            @endif

        @endforeach
    </ul>
</div>