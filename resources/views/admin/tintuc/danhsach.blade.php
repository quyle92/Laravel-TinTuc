@extends('admin/layout/index')

@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Title</th>
                                <th>Summary</th>
                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>Delete</th>
                                <th>Edit</th>
                                <th>Views</th>
                                <th>HOT</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc as $tt)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tt->id}}</td>
                                <td>{{$tt->TieuDe}} <br><img src="upload/tintuc/{{$tt->Hinh}}"  height="100" width="100"/></td>
                                <td>{{$tt->TomTat}}</td>
                                <td>{{$tt->TinTuctoLoaiTin->LoaiTintoTheLoai->Ten}}</td>
                                <td>{{$tt->TinTuctoLoaiTin->Ten}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{$tt->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{$tt->id}}">Edit</a></td>
                                <td>{{$tt->SoLuotXem}}</td>
                                <td> @if($tt->NoiBat == 1) {{'Có'}}@else {{'Ko'}}  @endif</td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection        