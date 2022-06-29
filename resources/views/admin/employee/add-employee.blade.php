@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br> <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Add New Employee</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{route('add.new.employee')}}" id="AddExamType" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Employee's Name</label>
                                <div class="form-group">
                                    <input class="form-control"  required type="text" id="name" name="name">
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
                                    <input class="form-control"  required type="text" id="fname" name="fname">
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
                                    <input class="form-control"  required type="text" id="mname" name="mname">
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
                                    <input class="form-control"  required type="text" id="mobile" name="mobile">
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
                                    <input class="form-control"  required type="text" id="address" name="address">
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
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>

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
                                    <option value="Islam">Islam</option>
                                    <option value="Traditionalist">Traditionalist</option>
                                    <option value="Christian">Christian</option>

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
                                    <input class="form-control"  required type="date" id="dob" name="dob">
                                </div>
                            </div>
                            @error('dob')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Join Date</label>
                                <div class="form-group">
                                    <input class="form-control"  required type="date" id="join_date" name="join_date">
                                </div>
                            </div>
                            @error('dob')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label>Employee Profile</label>
                            <input type="file" id="image" name="image" class="form-control">
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Salary</label>
                                <div class="form-group">
                                    <input class="form-control"  required type="text" id="salary" name="salary">
                                </div>
                            </div>
                            @error('dob')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label>Designation</label>
                            <div class="controls">
                                <select name="designation_id" id="designation_id" required class="form-control">
                                    <option value="" selected disabled>Select Designation</option>
                                    @foreach($designations as $designation)
                                    <option value="{{$designation->id}}">{{$designation->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <img src="{{asset('images/nopic.png')}}" alt="" id="new_image" style='height:90px; width:90px'>
                        </div>
                    </div>


                    <div>
                        <button type="submit" class="btn btn-primary mt-4">Add Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
                $('#AddExamType').validate({
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
