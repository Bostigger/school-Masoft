@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br> <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Student</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{url('students/update/'.$selected_student->student_id)}}" id="EditStudentForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="old_image" value="{{$selected_user->image}}">
                    <input type="hidden" class="form-control" name="id" value="{{$selected_student->id}}">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Student's Name</label>
                                <div class="form-group">
                                    <input class="form-control" value="{{$selected_user->name}}" required type="text" id="name" name="name">
                                </div>
                            </div>
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Father's Name</label>
                                <div class="form-group">
                                    <input class="form-control" value="{{$selected_user->fname}}" required type="text" id="fname" name="fname">
                                </div>
                            </div>
                            @error('fname')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mother's Name</label>
                                <div class="form-group">
                                    <input class="form-control" value="{{$selected_user->mname}}" required type="text" id="mname" name="mname">
                                </div>
                            </div>
                            @error('mname')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <div class="form-group">
                                    <input class="form-control" value="{{$selected_user->mobile}}"  required type="text" id="mobile" name="mobile">
                                </div>
                            </div>
                            @error('mobile')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Address</label>
                                <div class="form-group">
                                    <input class="form-control" value="{{$selected_user->address}}" required type="text" id="address" name="address">
                                </div>
                            </div>
                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Gender</label>
                                <div class="controls">
                                    <select name="gender" id="gender" required class="form-control">
                                        <option value="" selected disabled>Select Gender</option>
                                        <option value="male"   {{($selected_student['userClass']['gender']=="male")?"selected" : ""}}>Male</option>
                                        <option value="female" {{($selected_student['userClass']['gender']=="female")?"selected":""}}>Female</option>

                                    </select>
                                </div>
                            </div>
                            @error('gender')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Religion</label>
                            <div class="controls">
                                <select name="religion" id="religion" required class="form-control">
                                    <option value="" selected disabled>Select Religion</option>
                                    <option value="Islam" {{($selected_user->religion=="Islam")?"selected":""}}>Islam</option>
                                    <option value="Traditionalist" {{($selected_user->religion=="Traditionalist")?"selected":""}}>Traditionalist</option>
                                    <option value="Christian" {{($selected_user->religion=="Christian")?"selected":""}}>Christian</option>

                                </select>
                            </div>
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="form-group">
                                    <input class="form-control" value="{{$selected_user->dob}}" required type="date" id="dob" name="dob">
                                </div>
                            </div>
                            @error('dob')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Discount</label>
                                <div class="form-group">
                                    <input class="form-control" value="{{$selected_student['studentDiscount']['discount_amount']}}" required type="text" id="discount" name="discount">
                                </div>
                            </div>
                            @error('discount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
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
                            <label>Student Profile</label>
                            <input type="file" id="image"  name="image" class="form-control">
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <img src="{{asset($selected_user->image)}}" alt="" id="new_image" style='height:90px; width:90px'>
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
