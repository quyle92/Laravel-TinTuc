    	<div class="row carousel-holder">
            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    {{-- @foreach($slide as $sl) --}}
                     @for($i=1; $i<=count($slide); $i++)
                        <li data-target="#carousel-example-generic" data-slide-to="{{$i}}"
                        @if($i==1) class="active" @endif></li>
                     @endfor
                    <?php //$i++;?>
                   {{--  @endforeach --}}

                    </ol>
                    <div class="carousel-inner">
                       {{-- *** Cách 1 ***--}}
                        <?php //$i=1?>
                       {{--  @foreach($slide as $sl)  --}}
{{--                             @if($i==1)<div class="item active"> @else <div class="item"> @endif
                                <img class="slide-image" src="upload/slide/{{$sl->Hinh}}" alt="">
                            </div> --}}
                            <?php //$i++?>
                       {{--  @endforeach --}}

                      {{--***   Cách 2 ***--}}
                        <?php 
                            $x = 1;
                            foreach($slide as $sl) 
                            do {
                                if($x==1) echo '<div class="item active">
                                <img class="slide-image" src="upload/slide/'.$sl->Hinh.'" alt="">
                            </div>';
                                else  echo '<div class="item">
                                <img class="slide-image" src="upload/slide/'.$sl->Hinh.'" alt="">
                            </div>';
                                $x++;
                            } while ($x <= 1);
                            $x++;
                            
                        ?>

                    
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>