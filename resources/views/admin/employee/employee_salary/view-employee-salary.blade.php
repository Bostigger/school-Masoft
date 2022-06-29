@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br> <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Employee</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{url('employees/update-salary/'.$selected_employee->employee_id)}}" id="AddExamType" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Current Salary</label>
                                <div class="form-group">
                                    <input class="form-control"   value="{{$selected_employee->present_salary}}" required type="text" id="name" name="salary">
                                </div>
                            </div>
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Increase by Percent</label>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Increase by how many percent eg 5%"  required type="text" id="fname" name="increase_percent">
                                </div>
                            </div>
                            @error('fname')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Effected Date</label>
                                <div class="form-group">
                                    <input class="form-control"   required type="date" id="salary" name="effected_date">
                                </div>
                            </div>
                            @error('fname')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary mt-4">Increase Salary</button>
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
