@extends('admin.admin-master')
@section('admin')
    <br><div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">All Available Users</h3>
                <a href="{{route('add.user')}}" class="btn btn-rounded btn-info mb-5" style="float:right;">Add user</a>
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
                            <th>Role</th>
                            <th>Code</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($all_users as $key=> $user)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                            <td>{{$user->code}}</td>
                            <td>
                                <a href="{{url('users/user/edit/'.$user->id)}}"  type="button" class="btn btn-info mb-5">Edit</a>
                                <a href="{{url('users/user/delete/'.$user->id)}}" type="button" class="btn btn-danger mb-5" id="delete">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->


        <!-- /.box -->
    </div>
@endsection
