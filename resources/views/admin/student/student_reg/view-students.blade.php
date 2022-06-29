@extends('admin.admin-master')
@section('admin')
    <div class="row">
        <!--Bordery boxs!-->
      <div  class="box-body">
          <div class="col-md-12">
              <div class="box bb-3 border-warning">
                  <div class="box-header">
                      <h4 class="box-title">Search <strong>Student</strong></h4>
                  </div>
                  <div class="box-body">
                      <form method="GET" action="{{route('search.student')}}">
                          @csrf
                          <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Student Year</label>
                                      <div class="controls">
                                          <select name="year_id" id="year_id" required class="form-control">
                                              <option value="" selected disabled>Select Year</option>
                                              @foreach($student_years as $year)
                                                  <option value="{{$year->id}}" {{(@$last_inserted_year_id==$year->id)?"selected":""}}>{{$year->name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  @error('year_id')
                                  <span class="text-danger">{{$message}}</span>
                                  @enderror
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label>Student Class</label>
                                      <div class="controls">
                                          <select name="class_id" id="class_id" required class="form-control">
                                              <option value="" selected disabled>Select Class</option>
                                              @foreach($student_class as $class)
                                                  <option value="{{$class->id}}" {{($last_inserted_class_id==$class->id)?"selected":""}}>{{$class->name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  @error('name')
                                  <span class="text-danger">{{$message}}</span>
                                  @enderror
                              </div>
                              <div>
                                  <input type="submit" name="search" class="btn btn-info mb-5 mt-4" value="Search Student">
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <br><div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">All Students</h3>
                <a href="{{route('add.new.student.page')}}" class="btn btn-rounded btn-info mb-5" style="float:right;">Add New Student</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    @if(empty($_GET['search']))
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Year</th>
                            <th>Class</th>
                            <th>Roll</th>
                            <th>ID NO</th>
                            @if(Auth::user()->role='Admin')
                                <th>Code</th>
                            @endif
                            <th>Image</th>

                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($all_stud as $key=> $student)
                            <tr>
                                <th scope="row">{{$key++}}</th>
                                <td>{{$student['userClass']['name']}}</td>
                                <td>{{$student['studentYear']['name']}}</td>
                                <td>{{$student['studentClass']['name']}}</td>
                                <td>{{$student->roll}}</td>
                                <td>{{$student['userClass']['id_no']}}</td>
                                <td>{{$student['userClass']['code']}}</td>
                                <td><img src="{{asset($student['userClass']['image'])}}" alt="" style="width: 60px; height: 60px; border: 2px solid rosybrown"> </td>

                                <td>
                                    <a href="{{url('students/edit/'.$student->student_id)}}"  type="button" class="btn btn-info mb-5"><i class="fa fa-edit"></i></a>
                                    <a href="{{url('students/promote/'.$student->student_id)}}" type="button" class="btn btn-secondary mb-5" ><i class="fa fa-check"></i></a>
                                    <a href="{{url('students/details/'.$student->student_id)}}" type="button" class="btn btn-outline-primary mb-5" ><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            @else
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Year</th>
                                <th>Class</th>
                                <th>Roll</th>
                                <th>ID NO</th>
                                @if(Auth::user()->role='Admin')
                                    <th>Code</th>
                                @endif
                                <th>Image</th>

                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($searched_results as $key=> $student)
                                <tr>
                                    <th scope="row">{{$key++}}</th>
                                    <td>{{$student['userClass']['name']}}</td>
                                    <td>{{$student['studentYear']['name']}}</td>
                                    <td>{{$student['studentClass']['name']}}</td>
                                    <td>{{$student->roll}}</td>
                                    <td>{{$student['userClass']['id_no']}}</td>
                                    <td>{{$student['userClass']['code']}}</td>
                                    <td><img src="{{asset($student['userClass']['image'])}}" alt="" style="width: 60px; height: 60px; border: 2px solid rosybrown"> </td>

                                    <td>
                                        <a href="{{url('students/edit/'.$student->student_id)}}"  type="button" class="btn btn-info mb-5">Edit</a>
                                        <a href="{{url('students/delete/'.$student->student_id)}}" type="button" class="btn btn-danger mb-5" id="delete">Delete</a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            @endif
            <!-- /.box-body -->
        </div>
        <!-- /.box -->


        <!-- /.box -->
    </div>
@endsection
