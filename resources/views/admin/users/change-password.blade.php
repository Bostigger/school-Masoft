@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br> <div class="col-lg-7">
        <div class="box">
           @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oops!!</strong> {{session('error')}}
                </div>
            @elseif(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong></strong> {{session('success')}}
                </div>
            @endif
            <div class="box-header with-border">
                <h4 class="box-title">Change Password</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{route('update.password')}}" id="changePasswordForm" method="POST">
                    @csrf
                    <div class="col-md-7">
                        <div class="form-group">
                            <label>Current Password</label>
                            <div class="form-group">
                                <input class="form-control"  required type="password" id="password" name="current_password">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label>New Password</label>
                            <div class="form-group">
                                <input class="form-control"  required type="password" id="new_password" name="new_password">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label >Confirm Password</label>
                                <div class="form-group">
                                    <input class="form-control"  required type="password" id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                    </div>
                       <div>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                       </div>

                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
                $('#changePasswordForm').validate({
                    rules:{
                        current_pasword : {
                            required:true,
                        },
                        new_password : {
                            required:true,
                        },
                        password_confirmation : {
                            required:true,
                            equalTo:"#new_password"
                        },
                    },
                    messages:{
                        current_password:{
                          required:'Current Password Required'
                        },
                        new_password:{
                            required:'New Password required'
                        },
                        password_confirmation: {
                            required:'Confirm Password',
                            equalTo : 'Passwords do not match'
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

@endsection
