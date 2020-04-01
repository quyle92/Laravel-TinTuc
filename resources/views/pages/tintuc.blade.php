@extends('layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Post Content Column -->
            <div class="col-lg-9">
                <!-- Blog Post -->
                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>
                <!-- Author -->
                <p class="lead">
                    by <a href="#">Start Bootstrap</a>
                </p>
                <!-- Preview Image -->
                <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">
                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{date('F d, Y', strtotime($tintuc->created_at)) }}</p>
                <hr>
                <!-- Post Content -->
                <p class="lead"><?=htmlspecialchars_decode(htmlspecialchars($tintuc->NoiDung))?></p>
                <hr>
                <!-- Blog Comments -->
                <!-- Comments Form -->
                @if(Auth::check())
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <div class="well">
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form action="comment/{{$tintuc->id}}/{{Auth::id()}}" role="form" method="post">
                        <div class="form-group"> 
                            <textarea class="form-control" name="NoiDung" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>{!! csrf_field() !!}
                    </form>
                </div>
                <hr>
                @endif
                <!-- Posted Comments -->
                <!-- Comment -->
                @foreach($comment as $cm) {{-- @foreach($tintuc->TinTuctoComment as $cm) --}}
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$cm->CommenttoUser->name}}
                            <small>{{date('F d, Y',strtotime($cm->created_at))}}</small>
                        </h4>
                        {{$cm->NoiDung}}
                    </div>
                </div>
                @endforeach
                <!-- End Comment -->
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">
                        <!-- item -->
                        @foreach($tinlienquan as $tlq)
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="detail.html">
                                    <img class="img-responsive" src="image/320x150.png" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="#"><b>{{$tlq->TieuDe}}</b></a>
                            </div>
                            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p> --}}
                            <div class="break"></div>
                        </div>
                        @endforeach
                        <!-- end item -->
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                        <!-- item -->
                        @foreach($tinnoibat as $tnb)
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="detail.html">
                                    <img class="img-responsive" src="image/320x150.png" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="#"><b>{{$tnb->TieuDe}}</b></a>
                            </div>
                           {{--  <p>{{$tnb->TomTat}}</p> --}}
                            <div class="break"></div>
                        </div>
                        @endforeach
                        <!-- end item -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection