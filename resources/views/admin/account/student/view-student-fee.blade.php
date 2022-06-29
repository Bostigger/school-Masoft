@extends('admin.admin-master')
@section('admin')
    <div class="row">
        <!--Bordery boxs!-->

    </div>
    <br><div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Recent Payments</h3>
                <a href="{{route('add.student.fee.page')}}" class="btn btn-rounded btn-info mb-5" style="float:right;">Add/Edit Student Fee</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Student Name</th>
                            <th>ID NO</th>
                            <th>Year</th>
                            <th>Class</th>
                            <th>Fee Category</th>
                            <th>Date</th>
                            <th>Amount</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($all_student_fees as $key=> $fee)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$fee['userClass']['name']}}</td>
                                <td>{{$fee['userClass']['id_no']}}</td>
                                <td>{{$fee['studentYear']['name']}}</td>
                                <td>{{$fee['studentClass']['name']}}</td>
                                <td>{{$fee['feeCategory']['name']}}</td>
                                <td>{{$fee->date}}</td>
                                <td>{{$fee->amount}}</td>

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
