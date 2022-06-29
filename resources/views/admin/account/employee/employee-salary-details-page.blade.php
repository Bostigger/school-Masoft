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
                        <h4 class="box-title">Employee <strong> Salary Payment</strong></h4>
                    </div>
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('salary.payment.details.insert')}}" method="post">
                                    @csrf
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>ID No.</th>
                                            <th>Employee Name</th>
                                            <th>Original Salary</th>
                                            <th>Payable Fee</th>
                                            <th>Select</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($employees_data as $key=> $employee)
                                            @php
                                                $salary_amount = \App\Models\EmployeeSalary::where('employee_id',$employee->employee_id)->first();
                                                $account_fees = \App\Models\EmployeeAccountSalary::where('employee_id',$employee->employee_id)->where('date',$date)->first();
                                                if ($account_fees!=null){
                                                    $checked = 'checked';
                                                }else{
                                                    $checked = '';
                                                }
                                                $employee_data = \App\Models\EmployeeAttendance::where('employee_id',$employee->employee_id)->where('date',$date)->get();
                                                $count_absents = count($employee_data->where('attendance_status','absent'));

                                            @endphp
                                            <tr>
                                                <td>{{$employee['userClass']['id_no']}}</td>
                                                <td>{{$employee['userClass']['name']}} <input type="hidden" name="date" value="{{$date}}"></td>
                                                <td>{{$salary_amount->present_salary}} <input type="hidden" name="employee_id[]" value="{{$employee->employee_id}}"></td>
                                                <td>{{ (float)$salary_amount->present_salary -  (float)($salary_amount->present_salary)/30 * $count_absents   }}
                                                    <input type="hidden" name="amount[]" value="{{(float)$salary_amount->present_salary -  (float)($salary_amount->present_salary)/30 * $count_absents }}">
                                                </td>
                                                <td><input type="checkbox" {{$checked}}  name="check_manage[]" id="id{{$key}}" value="{{$key.$checked}}" style="transform: scale(1.5);margin-left: 10px;"><label
                                                        for="id{{$key}}"></label></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div>
                                        <input type="submit" class="btn btn-info" value="Update Employee Fees Payment">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
