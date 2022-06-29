@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br> <div class="col-lg-9">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Update Employee Leave</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{url('employees/update/'.$selected_leave->id)}}" id="AddExamType" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <label>Choose Employee</label>
                            <div class="controls">
                                <select name="employee_id" id="employee_id" required class="form-control">
                                    <option value="" selected disabled>Select Employee</option>
                                    @foreach($all_employees as $emp)
                                        <option value="{{$emp->id}}" {{($emp->id==$selected_leave->employee_id)?"selected":""}}>{{$emp->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-5">
                            <label>Purpose</label>
                            <div class="controls">
                                <select name="leave_purpose_id" id="employee_id" required class="form-control">
                                    <option value="" selected disabled>Select Leave Purpose</option>
                                    @foreach($all_leave_purposes as $purpose)
                                        <option value="{{$purpose->id}}" {{($purpose->id==$selected_leave->leave_purpose_id)?"selected":""}}>{{$purpose->leave_purpose}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5">
                            <label>Leave Start Date</label>
                            <div class="form-group">
                                <input name="start_date"  value="{{$selected_leave->start_date}}" id="start_date" class="form-control" type="date" required>
                            </div>
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-5">
                            <label>Leave End Date</label>
                            <div class="form-group">
                                <input name="end_date" id="end_date" value="{{$selected_leave->end_date}}"class="form-control" type="date" required>
                            </div>
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>



                    </div>


                    <div>
                        <button type="submit" class="btn btn-primary mt-4">Add New Leave</button>
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
