@extends('admin.admin-master')
@section('admin')
    <div class="row">
        <!--Bordery boxs!-->

    </div>
    <br><div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Recent Payments</h3>
                <a href="{{route('salary.payment.page')}}" class="btn btn-rounded btn-info mb-5" style="float:right;">Add/Edit Employee Payment</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee Name</th>
                            <th>ID NO</th>
                            <th>Date</th>
                            <th>Amount</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($all_employee_salary_payments as $key=> $fee)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$fee['userClass']['name']}}</td>
                                <td>{{$fee['userClass']['id_no']}}</td>
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
