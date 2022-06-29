@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br> <div class="col-lg-9">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Add New Leave</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{route('add.new.leave')}}" id="AddExamType" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <label>Choose Employee</label>
                            <div class="controls">
                                <select name="employee_id" id="employee_id" required class="form-control">
                                    <option value="" selected disabled>Select Employee</option>
                                    @foreach($all_employees as $emp)
                                        <option value="{{$emp->id}}">{{$emp->name}}</option>
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
                                <select name="leave_purpose_id" id="leave_purpose_id" required class="form-control">
                                    <option value="" selected disabled>Select Leave Purpose</option>
                                    @foreach($all_leave_purposes as $purpose)
                                        <option value="{{$purpose->id}}">{{$purpose->leave_purpose}}</option>
                                    @endforeach
                                    <option value="0">Other Matter</option>
                                </select>
                                <input type="text" name="new_purpose" placeholder="Enter Purpose" id="new_purpose" style="display: none" class="form-control mt-4">
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
                                <input name="start_date" id="start_date" class="form-control" type="date" required>
                            </div>
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-5">
                            <label>Leave End Date</label>
                            <div class="form-group">
                                <input name="end_date" id="start_date" class="form-control" type="date" required>
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
           $(document).on('change','#leave_purpose_id',function () {
              var leave_purpose = $(this).val();
              if(leave_purpose === '0'){
                  $('#new_purpose').show();
              }else{
                  $('#new_purpose').hide();
              }
           });
        });
    </script>

@endsection

