@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br> <div class="col-lg-8">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Add New User</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{route('add.new.user')}}" id="RegisterForm" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Choose Class <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="role" id="role" required class="form-control">
                                        <option value="" selected disabled>Select Role</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Operator">Operator</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <div class="form-group">
                                    <input class="form-control"  required type="email" id="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <div class="form-group">
                                    <input class="form-control"  required type="text"  id="name" name="name">
                                </div>
                            </div>
                        </div>
                    </div>



                    <div>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">All Available Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($all_users as $key=> $user)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{url('users/user/edit/'.$user->id)}}"  type="button" class="btn btn-info mb-5">Edit</a>
                                    <a href="{{url('users/user/delete/'.$user->id)}}" type="button" class="btn btn-danger mb-5">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {{$all_users->links()}}
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->


        <!-- /.box -->
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
                $('#RegisterForm').validate({
                    rules:{
                        name : {
                            required:true,
                        },
                        email : {
                            required:true,
                        },
                        password : {
                            required:true,
                        },
                        password_confirmation : {
                            required:true,
                            equalTo:"#password"
                        },
                    },
                    messages:{
                        name:{
                            required:'Please provide name'
                        },
                        email:{
                            required:'Email is required'
                        },
                        password:{
                            required:'Password required'
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
