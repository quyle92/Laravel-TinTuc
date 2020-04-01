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
				  	<div class="panel-heading">Thông tin tài khoản</div>
				  	<div class="panel-body">
				    	<form action="user-settings" method="post">
				    		@if(Auth::check())
				    		<div>
				    			<label>Họ tên</label>
							  	<input type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1" value="{{Auth::user()->name}}">
							</div>
							<br>
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1" value="{{Auth::user()->email}}"
							  	disabled
							  	>
							</div>
							<br>	
							<div>
								<input type="checkbox" class="" name="changePassword" id="changePassword">
									<label>Đổi mật khẩu</label>
							</div>
						
							<div id="password-area">

							  	<input type="password" class="form-control password" name="password" aria-describedby="basic-addon1" disabled>
				    			<label>Nhập lại mật khẩu</label>
							  	<input type="password" class="form-control password" name="passwordAgain" aria-describedby="basic-addon1" disabled>
							</div>
							<br>
							<button type="submit" class="btn btn-default">Sửa
							</button>{!! csrf_field() !!}
						@endif
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

@section('script')
<script>
	$(function(){
		$('#changePassword').change(function(){
			if(this.checked)
			{	
				  $(':password').removeAttr("disabled");
			}
			else if(!$(this).is(':checked'))
			{
				$(':password').prop("disabled",true);
				//alert('aa');
			}
	});
});
</script>
@endsection