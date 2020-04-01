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
                    @if($errors->any())
                        @foreach($errors->all() as $err)
                        <div class="alert alert-danger">
                            {{$err}}
                        </div>
                        @endforeach
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/loaitin/them" method="POST">
                            <div class="form-group">
                                <label>Category Parent</label>
                                <select class="form-control" name="TheLoai" placeholder="Please select" required>
                                    <option disabled selected>Please Choose Category</option>
                                    @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sub-Category Name</label>
                                <input class="form-control" name="Ten" placeholder="Please Enter Category Name" />
                            </div>
                            
                            <button type="submit" class="btn btn-default">Category Add</button>{!! csrf_field() !!}
                            <!--<button type="reset" class="btn btn-default">Reset</button>-->
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection