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

                    @if(session('comment_remove'))
                     <div class="alert alert-success">
                        {{session('comment_remove')}}
                    </div> 
                    @endif

                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype='multipart/form-data'>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default"> Add</button>
                                <label>Category Parent</label>
                                <select class="form-control" name="TheLoai" id="TheLoai">
                                    <option  disabled selected>Please Choose Category</option>
                                    @foreach($theloai as $tl)
                                    @if($tl->id == $tintuc->TinTuctoLoaiTin->LoaiTintoTheLoai->id)
                                    <option value="{{$tl->id}}" selected>{{$tl->Ten}}</option>
                                    @else
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sub-Category</label>
                                <select class="form-control" name="LoaiTin" id="LoaiTin">
                                    
                                    <option value="{{$tintuc->idLoaiTin}}">{{$tintuc->TinTuctoLoaiTin->Ten}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <textarea class="form-control" name="TieuDe"/>{{(old('TieuDe'))? old('TieuDe') :$tintuc->TieuDe  }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Summary</label>
                                <textarea class="form-control ckeditor" name="TomTat"  >{{(old('TomTat'))? old('TomTat') :$tintuc->TomTat  }} </textarea>
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea class="form-control ckeditor" name="NoiDung" >{{(old('NoiDungNoiDung'))? old('NoiDung') :$tintuc->NoiDung  }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Images</label>
                                <p><img src="{{"upload/tintuc/".$tintuc->Hinh}}" width=100 height=100/></p>
                                <input class="form-control" name="Hinh" type="file" value="{{$_SERVER['SERVER_NAME']."/upload/tintuc/".$tintuc->Hinh}}"/>
                            </div>
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" {{($tintuc->NoiBat == 1) ? 'checked':""}} type="radio">Có
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0" {{($tintuc->NoiBat == 0) ? 'checked':""}} type="radio">Ko
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default"> Add</button>{!! csrf_field() !!}
                            
                        <form>
                    </div>
                </div>
                <!-- /.row -->
                                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Users</th>
                                <th>Comments</th>
                                <th>Date</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc->TinTuctoComment as $cm)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cm->id}}</td>
                                <td>{{$cm->CommenttoUser->name}} </td>
                                <td>{{$cm->NoiDung}}</td>
                                <td>{{$cm->created_at}}</td>
                                <td><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}"> Delete</a></td>
                                
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
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