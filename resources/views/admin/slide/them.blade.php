@extends('admin.layout.index')

@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slides
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
                        <form action="admin/slide/them" method="POST"  enctype='multipart/form-data'>
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="Ten" />
                            </div>
                            <div class="form-group">
                                <label>Nội Dung</label>
                                <textarea class="form-control" name="NoiDung" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input class="form-control" name="link"  />
                            </div>
                            <div class="form-group">
                                <label>Hình</label>
                                <input class="form-control" name="Hinh" type="file" />
                            </div>
          
                            <button type="submit" class="btn btn-default">Category Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>{!! csrf_field() !!}
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection