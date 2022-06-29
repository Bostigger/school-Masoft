@extends('admin.admin-master')
@section('admin')
    <br><div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Assigned Subjects</h3>
                <a href="{{route('add.assign.subject.page')}}" class="btn btn-rounded btn-info mb-5" style="float:right;">Assign New Subject</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Class</th>
                            <th>Created At</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($assign_subject_pages as $key=> $assign_subject_page)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$assign_subject_page['StudentClass']['name']}}</td>
                                <td>{{$assign_subject_page->created_at}}</td>
                                <td>
                                    <a href="{{url('setups/assign-subject/edit/'.$assign_subject_page->student_class_id)}}"  type="button" class="btn btn-info mb-5">Edit</a>
                                    <a href="{{url('setups/assign-subject/details/'.$assign_subject_page->student_class_id)}}" type="button" class="btn btn-outline-primary mb-5" >Details</a>
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
