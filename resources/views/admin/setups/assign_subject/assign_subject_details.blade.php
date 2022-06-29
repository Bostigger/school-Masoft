@extends('admin.admin-master')
@section('admin')
    <br><div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Subject Assignment Details</h3>
                <a href="{{route('view.assign.subject')}}" class="btn btn-rounded btn-info mb-5" style="float:right;">Go back</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
           <h4>Subject Assignment:   {{$assignment_details[0]['StudentClass']['name'] }}</h4>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Pass Mark</th>
                            <th>Subjective Mark</th>
                            <th>Full Mark</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($assignment_details as $key=> $assign)
                            <tr>
                                <th scope="row">{{$key++}}</th>
                                <td>{{$assign['SubjectClass']['subject_name']}}</td>
                                <td>{{$assign->pass_mark}}</td>
                                <td>{{$assign->subjective_mark}}</td>
                                <td>{{$assign->full_marks}}</td>
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
