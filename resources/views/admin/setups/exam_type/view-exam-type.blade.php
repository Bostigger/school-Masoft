@extends('admin.admin-master')
@section('admin')
    <br><div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Available Exam Types</h3>
                <a href="{{route('add.exam.type.page')}}" class="btn btn-rounded btn-info mb-5" style="float:right;">Add Exam Type</a>
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

                        @foreach($exam_types as $key=> $exam)
                            <tr>
                                <th scope="row">{{$key++}}</th>
                                <td>{{$exam->name}}</td>
                                <td>{{$exam->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{url('setups/exam-type/edit/'.$exam->id)}}"  type="button" class="btn btn-info mb-5">Edit</a>
                                    <a href="{{url('setups/exam-type/delete/'.$exam->id)}}" type="button" class="btn btn-danger mb-5" id="delete">Delete</a>
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
