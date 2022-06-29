@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.min.js"></script>
    <div class="row">
        <!--Bordery boxs!-->
        <div  class="box-body">
            <div class="col-md-12">
                <div class="box bb-3 border-warning">
                    <div class="box-header">
                        <h4 class="box-title">Student <strong>Monthly Fee</strong></h4>
                    </div>
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>ID No</th>
                                        <th>Gender</th>
                                        <th>Discount</th>
                                        <th>Fee Amount</th>
                                        <th>Amount Payable</th>
                                        <th>Month</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($all_students as $key=> $student)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$student['UserClass']['name']}}</td>
                                            <td>{{$student['UserClass']['id_no']}}</td>
                                            <td>{{$student['UserClass']['gender']}}</td>
                                            <td>{{$student['studentDiscount']['discount_amount'] .'%'}}</td>
                                            <td>{{$monthly_fee->fee_amount}}</td>
                                            <td>{{(float)$monthly_fee->fee_amount - ($monthly_fee->fee_amount * ($student['studentDiscount']['discount_amount'])/100) .'$' }}</td>
                                            <td>{{$selected_month}}</td>
                                            <td>
                                                <a class="btn btn-sm btn-success'" title="Payslip" target="_blank" href="{{route('monthly.fee.payslip',[$student->student_id,$student->class_id,$selected_month])}}">Fee Slip</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
