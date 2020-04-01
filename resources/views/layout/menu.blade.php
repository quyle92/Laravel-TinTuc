
                <ul class="list-group" id="menu">
                    <li href="#" class="list-group-item menu1 active">
                    	Menu
                    </li>
                    
                    @foreach($theloai as $tl)
                        @if(count($tl->TheLoaitoLoaiTin)>0)
                        <li href="#" class="list-group-item menu1">
                        	{{$tl->Ten}}
                        </li>
                        <ul>
                            @foreach($tl->TheLoaitoLoaiTin as $lt)
                    		<li class="list-group-item">{{-- {{dd($lt)}} --}}
                    			<a href="loaitin/{{$lt->id}}">{{$lt->Ten}}</a>
                        	</li>
                            @endforeach
                        </ul>
                        @endif
                    @endforeach
                    
                </ul>
        