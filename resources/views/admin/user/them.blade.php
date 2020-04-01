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
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/user/them" method="POST">
                            <div class="form-group">
                                <label> Name</label>
                                <input class="form-control" name="name" placeholder="Please Enter Category Name" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Please Enter Category Order" />
                            </div>
                            <div class="form-group">
                                <label>Passsword</label>
                                <input class="form-control" name="password" placeholder="Please Enter Category Keywords" />
                            </div>
                            <div class="form-group">
                                <label>Passsword Again</label>
                                <input class="form-control" name="passwordAgain" placeholder="Please Enter Category Keywords" />
                            </div>
                            <div class="form-group">
                                <label>Level</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" checked="" type="radio">Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" type="radio">Guest
                                </label>
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