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
                        <form action="admin/user/sua/{{$user->id}}" method="POST">
                            <div class="form-group">
                                <label> Name</label>
                                <input class="form-control" name="name" placeholder="Please Enter Category Name" value="{{(old('name'))?old('name'):$user->name}}"/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Please Enter Category Order" value="{{(old('email'))?old('email'):$user->email}}"/>
                            </div>
                            <div class="form-group"><input type="checkbox" id="changePassword" name="changePassword"> Change Passsword</div> {{--trong tag input type="checkbox" ko đc để value="" nếu ko câu lệnh "if ($request->changePassword == "on")" ở UserController sẽ ko trả về TRUE vì nếu value="" thì changePassword="" chứ ko phải ="on" --}}
                            <div class="form-group">
                                <label>Passsword</label>
                                <input class="form-control password" name="password" placeholder="Please Enter Category Keywords" disabled/>
                            </div>
                            <div class="form-group">
                                <label>Passsword Again</label>
                                <input class="form-control password" name="passwordAgain" placeholder="Please Enter Category Keywords" disabled/>
                            </div>
                            <div class="form-group">
                                <label>Level</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1"  @if(old('quyen')=="1") {{"checked"}} @elseif($user->quyen==1)) {{"checked"}} @else {{""}} @endif type="radio">Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" @if(old('quyen')=="0" ) {{"checked"}} @elseif($user->quyen==0)) {{"checked"}} @else {{""}} @endif type="radio">Guest
                                </label>{{-- {{$user->quyen}}-{{var_dump(old('quyen'))}} --}}
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

@section('script')
    <script type="text/javascript">
        $(function() {
            $('#changePassword').change(function(){
                if(this.checked)
                {
                     $('.password').removeAttr("disabled");
                } else 
                {
                     $('.password').prop("disabled",true);
                }
            });

        });

    </script>

@endsection