    @extends('admin.layout.index')

@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>Add</small>
                        </h1>
                    </div>

                    <!-- /.col-lg-12 -->
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $err)
                               <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div> 
                    @endif

                    @if(session('img_error'))
                     <div class="alert alert-danger">
                        {{session('img_error')}}
                    </div> 
                    @endif

                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/tintuc/them" method="POST" enctype='multipart/form-data'>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default"> Add</button>
                                <label>Category Parent</label>
                                <select class="form-control" name="TheLoai" id="TheLoai">
                                    <option  disabled selected>Please Choose Category</option>
                                    @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sub-Category</label>
                                <select class="form-control" name="LoaiTin" id="LoaiTin">
                                    <option value="0">Please Choose Sub-Category</option>
                                    <option value="">Tin Tức</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <textarea class="form-control" name="TieuDe" />{{old('TieuDe')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Summary</label>
                                <textarea class="form-control ckeditor" name="TomTat"  />{{old('TomTat')}} </textarea>
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea class="form-control ckeditor" name="NoiDung" >{{old('NoiDung')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Images</label>
                                <input class="form-control" name="Hinh" type="file" />
                            </div>
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" checked="" type="radio">Có
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0" type="radio">Ko
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default"> Add</button>{!! csrf_field() !!}
                            
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection

@section('script')
    <script type="text/javascript">
       $(function() {
        
            $("#TheLoai").change(function(){
               var idTheLoai = $("#TheLoai").val();
               $.get('admin/ajax/loaitin/' + idTheLoai, function(data){
                    $('#LoaiTin').html(data);
                });
            });
            
        });
    </script>

 


@endsection