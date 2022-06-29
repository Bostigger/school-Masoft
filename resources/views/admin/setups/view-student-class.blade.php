@extends('admin.admin-master')
@section('admin')
    <br><div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Student Classes</h3>
                <a href="{{route('add.student.page')}}" class="btn btn-rounded btn-info mb-5" style="float:right;">Add Student Class</a>
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

                        @foreach($student_class as $class)
                            <tr>
                                <th scope="row">{{$student_class -> firstItem()+$loop->index}}</th>
                                <td>{{$class->name}}</td>
                                <td>{{$class->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{url('setups/student-class/edit/'.$class->id)}}"  type="button" class="btn btn-info mb-5">Edit</a>
                                    <a href="{{url('setups/student-class/delete/'.$class->id)}}" type="button" class="btn btn-danger mb-5" id="delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {{$student_class->links()}}
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->


        <!-- /.box -->
    </div>
@endsection
