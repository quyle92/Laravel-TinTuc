@extends('layout.index')

@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-3 ">
                @include('layout.menu')
            </div>

            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>Từ khóa: {{$term}}</b></h4>
                    </div>
                @foreach($tintuc as $tt)
                    <div class="row-item row">
                        <div class="col-md-3">

                            <a href="detail.html">
                                <br>
                                <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{$tt->Hinh}}" alt="">
                            </a>
                        </div>

                        <div class="col-md-9">
                            <h3>{{$tt->TieuDe}}</h3>
                            <p>{{$tt->TomTat}}</p>
                            <a class="btn btn-primary" href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">Xem Thêm <span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <div class="break"></div>
                    </div>

                @endforeach
                

                    <!-- Pagination -->
                    <div class="row text-center">
                        <div class="col-lg-12">
                 {{-- Cách 1 --}}           
                {!!$tintuc->links()!!}
                {{-- Cách 2: ko cần $tintuc = $tintuc->appends(['term' => $term]) ở function search--}} 
             {{--    {!!$tintuc->appends(Request::only('term'))->links()!!} --}}
             {{-- {{ $product->appends(['term' => Request::get('term')])->links() }} --}}
                {{-- Cách 3: ko cần $tintuc = $tintuc->appends(['term' => $term]) ở function search --}} 
                {{-- {!!$tintuc->appends(Request::all())->links()!!} --}}
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div> 

        </div>

    </div>
    <!-- end Page Content -->
@endsection