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
                        <h4 class="box-title">Student <strong>MarkSheet View</strong></h4>
                    </div>
                    <div class="box-body">
                      <di class="row">
                          <div class="col-md-4">
                              <img src="{{asset('images/header.jpg')}}"  style="height: 90px; width: 120px" alt="">
                          </div>
                          <div class="col-md-2">

                          </div>
                          <div class="col-md-3" style="float:left;">
                              <h4>SchoolMasoft</h4>
                              <h6>support@schoolmasoft.com</h6>
                              <h5><strong><i>Student Transcript</i></strong></h5>
                              <h5>{{$all_marks[0]['ExamTypeClass']['name']}}</h5>
                          </div>

                          <div class="col-md-12">
                              <hr style="border: solid 1px #ddd; width: 100%; margin-bottom: 0px;">
                              <p style="float: right">Print Date {{date('d-m-y')}}</p>
                          </div>
                      </di>
                        <h5>Student Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered table-striped" >
                                    @php
                                        $selected_student = \App\Models\AssignStudent::where('year_id',$all_marks['0']['year_id'])
                                        ->where('class_id',$all_marks['0']['class_id'])->where('student_id',$all_marks['0']['student_id'])->first();
                                        #dd($selected_student->toArray());
                                    @endphp

                                    <tbody>
                                    <tr>
                                        <td>Student Name</td>
                                        <td>{{$selected_student['userClass']['name']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Student ID</td>
                                        <td>{{$selected_student['userClass']['id_no']}}</td>
                                    </tr>

                                    <tr>
                                        <td>Student Year</td>
                                        <td>{{$selected_student['studentYear']['name']}}</td>
                                    </tr>

                                    <tr>
                                        <td>Student Group</td>
                                        <td>{{$selected_student['studentGroup']['name']}}</td>
                                    </tr>

                                    <tr>
                                        <td>Student Class</td>
                                        <td>{{$selected_student['studentClass']['name']}}</td>
                                    </tr>

                                    <tr>
                                        <td>Student Roll</td>
                                        <td>{{$selected_student->roll}}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered table-striped" >
                                    @php
                                        $selected_student = \App\Models\AssignStudent::where('year_id',$all_marks['0']['year_id'])
                                        ->where('class_id',$all_marks['0']['class_id'])->where('student_id',$all_marks['0']['student_id'])->first();
                                        #dd($selected_student->toArray());
                                    @endphp
                                    <thead>
                                    <tr>
                                        <th>Letter Grade</th>
                                        <th>Marks Interval</th>
                                        <th>Grade Point</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($all_grade as $key=> $grade)
                                        <tr>
                                            <td>{{$grade ->grade_name}}</td>
                                            <td>{{$grade ->start_marks}} - {{$grade -> end_marks}}</td>
                                            <td>{{number_format((float)$grade ->start_point,2)}} -{{number_format((float)$grade ->end_point,2)}} </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-12">
                              <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Student Marks</th>
                                    <th>Letter Grade</th>
                                    <th>Grade Point</th>
                                    <th>Remarks</th>
                                </tr>
                                </thead>
                                  <tbody>
                                  @php
                                  $total_marks = 0.0;
                                  $total_point = 0.0;
                                  @endphp
                                    @foreach($all_marks as $key=> $student_mark)

                                        @php
                                        $student_grade = \App\Models\GradeMarks::where([['start_marks','<=',(int)$student_mark->marks],['end_marks','>=',(int)$student_mark->marks]])->first();
                                        $total_point = $total_point + $student_grade->grade_point;
                                        $total_marks = $total_marks + $student_mark->marks;
                                        $total_subjects = \App\Models\StudentMarks::where('year_id',$student_mark->year_id)->where('class_id',$student_mark->class_id)->where('exam_type_id',$student_mark->exam_type_id)->where('student_id',$student_mark->student_id)->get()->count();
                                        $subject = \App\Models\AssignSubject::where('student_class_id',$student_mark->class_id)->where('id',$student_mark->assign_subject_id)->first();

                                        @endphp
                                      <tr>

                                           <td>{{$subject['SubjectClass']['subject_name']}}</td>
                                          <td>{{$student_mark -> marks}}</td>
                                          <td>{{$student_grade->grade_name}}</td>
                                          <td>{{number_format((float)$student_grade->grade_point,2)}}</td>
                                          <td>{{$student_grade->remarks}}</td>

                                      </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                                <h5>Total Marks: {{$total_marks}}/{{(float)$total_subjects * 100}}</h5>
                                <h5>Total Point: {{number_format((float)$total_point,2)}}/{{(float)$total_subjects * 5}}</h5>
                                @php
                                $total_sub = (float)$total_subjects * 100;
                                $performance_remarks= '';
                                if ($total_marks >= (80/100*$total_sub)){
                                    $performance_remarks= 'Excellent';
                                }elseif($total_marks >= (60/100*$total_sub))
                                    {
                                        $performance_remarks= 'Very Good';
                                    }
                                elseif($total_marks >= (50/100*$total_sub))
                                    {
                                        $performance_remarks= 'Average';
                                    }else{
                                        $performance_remarks= 'Poor';
                                    }
                                @endphp
                                <div>
                                    <hr style="border: dot-dot-dash;">
                                    <h4>Performance Remarks: {{$performance_remarks}}</h4>
                                    <hr style="border: dot-dot-dash">
                                </div>
                            </div>
                        </div>
                        <br><br><br><br>
                        <div class="row">
                            <div class="col-md-3">
                                <hr style="border:dashed 1px #ddd;">
                                <div class="text-center">
                                    Teacher
                                </div>
                            </div>
                            <div class="col-md-3">
                                <hr style="border:dashed 1px #ddd;">
                                <div class="text-center">
                                    Parents/Guardian
                                </div>
                            </div>
                            <div class="col-md-3">
                                <hr style="border:dashed 1px #ddd;">
                                <div class="text-center">
                                    Principal
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
