@extends('admin/layout/index')

@section('content')

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>Edit</small>
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
                        <form action="admin/loaitin/sua/{{$loaitin->id}}" method="POST">
                            <div class="form-group">
                                <label>Category Parent</label>
                                <select class="form-control" name="TheLoai">
                                    <option disabled>Please Choose Category</option>
                                    @foreach($theloai as $tl)
                                        @if($tl->id == $loaitin->idTheLoai)
                                            <option value="{{$tl->id}}" selected>
                                                {{$tl->Ten}}
                                            </option>
                                        @else
                                            <option value="{{$tl->id}}" >
                                                {{$tl->Ten}}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                               {{--  @foreach($loaitin as $lt) --}}
                                <input class="form-control" name="Ten" value="@if(old('Ten')) {{old('Ten')}} @else{{$loaitin->Ten}}@endif" />
                                {{-- @endforeach --}}
                            </div>
      
                            <button type="submit" class="btn btn-default">Category Edit</button>{!! csrf_field() !!}
                            
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection    