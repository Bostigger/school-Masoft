@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br> <div class="col-lg-9">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Promote Student</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{url('students/promote/update/'.$selected_student->student_id)}}" id="EditStudentForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" name="id" value="{{$selected_student->id}}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Student Year</label>
                                <div class="controls">
                                    <select name="year_id" id="year_id" required class="form-control">
                                        <option value="" selected disabled>Select Year</option>
                                        @foreach($student_years as $year)
                                            <option value="{{$year->id}}" {{($selected_student['studentYear']['id']==$year->id)?"selected":""}}>{{$year->name}}</option>
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
                                            <option value="{{$class->id}}" {{($selected_student['studentClass']['id']==$class->id)?"selected":""}}>{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Student Shift</label>
                                <div class="controls">
                                    <select name="shift_id" id="shift_id" required class="form-control">
                                        <option value="" selected disabled>Select Shift</option>
                                        @foreach($all_shifts as $shift)
                                            <option value="{{$shift->id}}" {{($selected_student['studentShift']['id']==$shift->id)?"selected":""}}>{{$shift->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('shift_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label>Student Group</label>
                            <div class="controls">
                                <select name="group_id" id="group_id" required class="form-control">
                                    <option value="" selected disabled>Select Group</option>
                                    @foreach($student_groups as $group)
                                        <option value="{{$group->id}}" {{($selected_student['studentGroup']['id']==$group->id)?"selected":""}} >{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Update Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
                $('#EditStudentForm').validate({
                    rules:{
                        name : {
                            required:true,
                        },

                    },
                    messages:{
                        name:{
                            required:'Please provide name'
                        },

                    },
                    errorElement : 'span',
                    errorPlacement: function (error,element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight : function (element,errorClass,validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight : function (element,errorClass,validClass) {
                        $(element).removeClass('is-invalid');
                    },
                })

            }
        )
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#image').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#new_image').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>

@endsection
