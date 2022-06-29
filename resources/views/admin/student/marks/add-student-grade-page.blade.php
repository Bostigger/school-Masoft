@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br> <div class="col-lg-9">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Add New Grade</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{route('add.new.grade')}}" id="AddExamType" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Grade Name</label><span class="text-danger">*</span>
                                <div class="form-group">
                                    <input class="form-control"  required type="text" id="grade_name" name="grade_name">
                                </div>
                            </div>
                            @error('grade_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Grade Point</label><span class="text-danger">*</span>
                                <div class="form-group">
                                    <input class="form-control"  required type="text" id="grade_point" name="grade_point">
                                </div>
                            </div>
                            @error('grade_point')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Start Marks</label><span class="text-danger">*</span>
                                <div class="form-group">
                                    <input class="form-control"  required type="text" id="start_marks" name="start_marks">
                                </div>
                            </div>
                            @error('start_marks')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>End Marks</label><span class="text-danger">*</span>
                                <div class="form-group">
                                    <input class="form-control"  required type="text" id="end_marks" name="end_marks">
                                </div>
                            </div>
                            @error('end_marks')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Start Point</label><span class="text-danger">*</span>
                                <div class="form-group">
                                    <input class="form-control"  required type="text" id="start_point" name="start_point">
                                </div>
                            </div>
                            @error('start_point')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>End Point</label><span class="text-danger">*</span>
                                <div class="form-group">
                                    <input class="form-control"  required type="text" id="end_point" name="end_point">
                                </div>
                            </div>
                            @error('end_point')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Remarks</label><span class="text-danger">*</span>
                                <div class="form-group">
                                    <input class="form-control"  required type="text" id="remarks" name="remarks">
                                </div>
                            </div>
                            @error('grade_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    <div>
                            <button type="submit" class="btn btn-primary mt-4">Add New Grade</button>
                    </div>
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
