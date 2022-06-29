@extends('admin.admin-master')
@section('admin')
    <div class="row">
        <!--Bordery boxs!-->

    </div>
    <br><div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">All Employees</h3>
                <a href="" class="btn btn-rounded btn-info mb-5" style="float:right;"></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>ID NO</th>
                            <th>Name</th>
                            <th>Join Date</th>
                            <th>Salary</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($all_employees as $key=> $emp)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$emp->id_no}}</td>
                                <td>{{$emp->name}}</td>
                                <td>{{$emp->join_date}}</td>
                                <td>{{$emp->salary}}</td>
                                <td>
                                    <a href="{{url('employees/manage-salary/view/'.$emp->id)}}"  type="button"  title="increment" class="btn btn-info mb-5"><i class="fa fa-plus"></i></a>
                                    <a href="{{url('employees/details/'.$emp->id)}}" type="button"  title="details" class="btn btn-outline-primary mb-5" ><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- /.box -->


        <!-- /.box -->
    </div>
@endsection
