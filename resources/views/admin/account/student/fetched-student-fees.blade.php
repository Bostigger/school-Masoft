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
                        <h4 class="box-title">Student <strong> Fee</strong></h4>
                    </div>
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('insert.student.fees')}}" method="post">
                                    @csrf
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID No.</th>
                                                <th>Student Name</th>
                                                <th>Fathers Name</th>
                                                <th>Original Fee</th>
                                                <th>Discount Amount</th>
                                                <th>Payable Fee</th>
                                                <th>Select</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($selected_students as $key=> $student)
                                            @php
                                            $registration_fee = \App\Models\FeeCategoryAmount::where('fee_category_id',$fee_category_id)->where('student_class_id',$class_id)->first();
                                            $account_fees = \App\Models\StudentFee::where('student_id',$student->student_id)->where('year_id',$student->year_id)->where('class_id',$student->class_id)->where('fee_category_id',$fee_category_id)->where('date',$date)->first();
                                            if ($account_fees!=null){
                                                $checked = 'checked';
                                            }else{
                                                $checked = '';
                                            }
                                            @endphp
                                             <tr>
                                                 <td>{{$student['userClass']['id_no']}} <input type="hidden" name="fee_category_id" value="{{$fee_category_id}}"></td>
                                                 <td>{{$student['userClass']['name']}} <input type="hidden" name="year_id" value="{{$student->year_id}}"></td>
                                                 <td>{{$student['userClass']['fname']}} <input type="hidden" name="class_id" value="{{$student->class_id}}"></td>
                                                 <td>{{$student['studentDiscount']['discount_amount']}} <input type="hidden" name="date" value="{{$date}}"></td>
                                                 <td><input type="text" name="account[]" class="form-control" readonly value="{{(float)$registration_fee->fee_amount - (float)($student['studentDiscount']['discount_amount'])/100*$registration_fee->fee_amount}}"></td>
                                                 <td>{{$registration_fee->fee_amount}} <input type="hidden" name="student_id[]" value="{{$student->student_id}}"></td>
                                                    <td><input type="checkbox" {{$checked}}  name="check_manage[]" id="id{{$key}}" value="{{$key.$checked}}" style="transform: scale(1.5);margin-left: 10px;"><label
                                                         for="id{{$key}}"></label></td>
                                             </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div>
                                        <input type="submit" class="btn btn-info" value="Update Student Fees">
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
