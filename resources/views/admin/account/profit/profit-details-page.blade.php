@extends('admin.admin-master')
@section('admin')
    <div class="row">
        <!--Bordery boxs!-->

    </div>
    <br><div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Monthly Profit </h3>
                <p class="text-secondary" style="float:right;"><strong>FROM: </strong>{{$start_date}} <strong>TO: </strong>{{$end_date}}</p>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table  class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Total Student Fees</th>
                            <th>Total Employee Salaries</th>
                            <th>Other Cost</th>
                            <th>Profit</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                               <td>{{$student_fees}}</td>
                               <td>{{$employee_payment_fees}}</td>
                               <td>{{$other_costs}}</td>
                               <td class="{{($monthly_profit<0)?"text-danger":"text-success"}}">{{$monthly_profit}}</td>
                               <td>
                                   <a href="{{route('view.profit.details',[$start_date,$end_date])}}" class="btn btn-info">Export as Pdf</a>
                               </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- /.box -->


        <!-- /.box -->
    </div>
@endsection
