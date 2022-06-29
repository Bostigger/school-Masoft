@extends('admin.admin-master')
@section('admin')

    <br> <div class="col-lg-6">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit User</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{url('users/update/user/'.$selected_user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$selected_user->photo_url}}" name="old_image">
                    <div class="col-md-12">
                        <div class="form-group">
                            <h5>Choose Role <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="role" id="role" required class="form-control">
                                    <option value="" selected disabled>Select Role</option>
                                    <option value="Admin" {{$selected_user -> role=='Admin'?"selected":''}}>Admin</option>
                                    <option value="Operator" {{$selected_user -> role=='Operator'?"selected":''}}>Operator</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-1">Name</label>
                        <div class="col-md-7">
                            <input class="form-control" value="{{$selected_user->name}}" required type="text" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-1">Email</label>
                        <div class="col-md-7">
                            <input class="form-control" value="{{$selected_user->email}}" required type="email" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Profile Picture</label>
                        <input type="file" name="photo_url" id="photo_url">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Update User</button>
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

                        @foreach($all_users as $user)
                            <tr>
                                <th scope="row">{{$all_users -> firstItem()+$loop->index}}</th>
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

@endsection
