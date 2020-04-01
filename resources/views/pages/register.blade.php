@extends('layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container">
    @if(session('success'))
	<div class="alert alert-success">
			{{session('success')}}
	</div>
	@endif

	@if($errors->any())
	<div class="alert alert-danger">
	    <ul>
	        @foreach($errors->all() as $err)
	           <li>{{ $err }}</li>
	        @endforeach
	    </ul>
	</div> 
	@endif
                    
	@if(session('message'))
	<div class="alert alert-warning">
			{{session('message')}}
	</div>
	@endif
    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				  	<div class="panel-heading">Đăng ký tài khoản</div>
				  	<div class="panel-body">
				    	<form action = "register" method="post">
				    		<div>
				    			<label>Họ tên</label>
							  	<input type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1" value="{{old('name')}}">
							</div>
							<br>
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1" value="{{old('email')}}"
							  	>
							</div>
							<br>	
							<div>
								<input type="checkbox" class="" name="checkpassword">
				    			<label>Nhập mật khẩu</label>
							  	<input type="password" class="form-control" name="password" aria-describedby="basic-addon1">
							</div>
							<br>
							<div>
				    			<label>Nhập lại mật khẩu</label>
							  	<input type="password" class="form-control" name="passwordAgain" aria-describedby="basic-addon1">
							</div>
							<br>
							<button type="submit" class="btn btn-default">Đăng ký
							</button>{!! csrf_field() !!}

				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
@endsection    