@extends('admin.admin-master')
@section('admin')

    <br><div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Employee Leaves</h3>
                <a href="{{route('add.leave.purpose.page')}}" class="btn btn-rounded btn-info mb-5 " style="float:right;">Add Leave Purpose</a>
                <a href="{{route('add.new.leave.page')}}" class="btn btn-rounded btn-primary mb-5 mr-5" style="float:right;">Add New Leave</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Leave Purpose</th>
                                <th>Leave Date</th>
                                <th>Return Date</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($all_leave_data as $key=> $leave)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$leave['UserClass']['name']}}</td>
                                    <td>{{$leave['LeavePurpose']['leave_purpose']}}</td>
                                    <td>{{$leave->start_date}}</td>
                                    <td>{{$leave->end_date}}</td>
                                    <td>
                                        <a href="{{url('employees/edit/'.$leave->id)}}"  type="button" class="btn btn-info mb-5"><i class="fa fa-edit"></i></a>
                                        <a href="{{url('employees/details/'.$leave->id)}}" type="button"  class="btn btn-secondary mb-5" ><i class="fa fa-eye"></i></a>
                                        <a href="{{url('employees/delete/'.$leave->id)}}" type="button" id="delete" class="btn btn-warning mb-5" ><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                </div>
            </div><!-- /.box-body -->
        </div>
        <!-- /.box -->


        <!-- /.box -->
    </div>
@endsection
