@extends('admin.admin-master')
@section('admin')
    <br><div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Student Shifts</h3>
                <a href="{{route('add.student.shift.page')}}" class="btn btn-rounded btn-info mb-5" style="float:right;">Add Student Shift</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($student_shift as $key=> $shift)
                            <tr>
                                <th scope="row">{{$key++}}</th>
                                <td>{{$shift->name}}</td>
                                <td>{{$shift->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{url('setups/student-shift/edit/'.$shift->id)}}"  type="button" class="btn btn-info mb-5">Edit</a>
                                    <a href="{{url('setups/student-shift/delete/'.$shift->id)}}" type="button" class="btn btn-danger mb-5" id="delete">Delete</a>
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
