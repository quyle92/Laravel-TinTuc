@extends('layout.index')
@section('content')
    <div class="container">
    	<!-- slider -->
			@include('layout.slide')
        <!-- end slide -->
        <div class="space20"></div>
        <div class="row main-left">
        	<div class="col-md-3 ">
				@include('layout.menu')
			</div>
            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
	            	</div>
	            	<div class="panel-body">
	            		<!-- item -->{{-- {{dd($theloai)}} --}}
	            		<?php $i=0; echo $n = iterator_count($theloai);?>
	            		@foreach($theloai as $tl)
	            		@if(count($tl->TheLoaitoLoaiTin)>0)	
					    <div class="row-item row">
		                	<h3>
		                		<a href="category.html">{{$tl->Ten}}</a> | 
		                		@foreach($tl->TheLoaitoLoaiTin as $lt)
		                		<small><a href="category.html"><i>{{$lt->Ten}}</i></a>/</small>
		                		@endforeach
		                	</h3>
		                	<?php 
		                	//if(count($tl->TheLoaitoLoaiTin)>0)
		                	//$data = $tl->TheLoaitoLoaiTintoTinTuc->where("NoiBat",1)->sortByDesc("created_at")->take(5);
		                	//Cách 1: $data1 = $data->shift();//print_r($data); 
		                	$data1 = $data->values();
		                	?>
		                	<div class="col-md-8 border-right">
		                		<div class="col-md-5">
			                        <a href="detail.html">
			                            <img class="img-responsive" src="upload/tintuc/{{$data1->get(0)->Hinh}}" alt=""> {{--Cách 1: or {{$data1->Hinh}} --}}
			                        </a>
			                    </div>
			                    <div class="col-md-7">
			                        <h3>{{$data1->get(0)->TieuDe}}</h3>
			                        {{-- @if(count($data)>0) {{111}} @endif  ktra xem $data có elements nào trong đó ko mà gọi $data[0]->TieuDe ko đc--}}
			                        <p>{{$data1->get(0)->TomTat}}</p>
			                        <a class="btn btn-primary" href="tintuc/{{$data1->get(0)->id}}/{{$data1->get(0)->TieuDeKhongDau}}.html">View Project <span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>
		                	</div>
		                	<?php //cách 2:
		                	//$data = $tl->TheLoaitoLoaiTintoTinTuc()->where("NoiBat",1)->orderby("created_at","desc")->offset(1)->limit(4)->get();	
		                	//then loop through them via foreach ($data as $tintuc)
		                	?>
		                	<?php $data->shift();// gọi shift để  removes first  element of collection?>
		                	@foreach($data as $tintuc)
							<div class="col-md-4">
								<a href="detail.html">
									<h4>
										<span class="glyphicon glyphicon-list-alt"></span>
										{{$tintuc->TieuDe}}
									</h4>
								</a>  
							</div>
							@endforeach
						 	<?php   ++$i?>
						 <div class="break"></div>
		                </div>
		                @endif
		                @endforeach
		                <?php echo $i?>
		                <!-- end item -->
					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
@endsection 