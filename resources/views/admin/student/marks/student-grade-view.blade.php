@extends('admin.admin-master')
@section('admin')
    <div class="row">
        <!--Bordery boxs!-->

    </div>
    <br><div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Available Grades</h3>
                <a href="{{route('add.new.grade.page')}}" class="btn btn-rounded btn-info mb-5" style="float:right;">Add New Grade</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Grade Name</th>
                                <th>Grade Point</th>
                                <th>Start Marks</th>
                                <th>End Marks</th>
                                <th>Point Range</th>
                                <th>Remarks</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($all_grade as $key=> $grade)
                                <tr>
                                    <th scope="row">{{$key++}}</th>
                                    <td>{{$grade -> grade_name}}</td>
                                    <td>{{number_format((float)$grade -> grade_point,2)}}</td>
                                    <td>{{$grade -> start_marks}}</td>
                                    <td>{{$grade -> end_marks}}</td>
                                    <td>{{$grade -> start_point}} - {{$grade -> end_point}} </td>
                                    <td>{{$grade -> remarks}}</td>
                                    <td>
                                        <a href="{{url('marks/grade/edit/'.$grade->id)}}"  type="button" class="btn btn-info mb-5"><i class="fa fa-edit"></i></a>
                                        <a href="{{url('marks/grade/delete/'.$grade->id)}}" type="button" id="delete"class="btn btn-outline-primary mb-5" ><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <!-- /.box -->
    </div>
@endsection
