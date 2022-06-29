@extends('admin.admin-master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br> <div class="col-lg-8">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Update Student Group</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{url('setups/student-group/update/'.$selected_group->id)}}" id="EditStudentClass" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Enter Group Name</label>
                                <div class="form-group">
                                    <input class="form-control"  required type="text" value="{{$selected_group->name}}" id="name" name="name">
                                </div>
                            </div>
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Update Student Group</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">All Available Student Groups</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($student_group as $key=> $group)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$group->name}}</td>
                                <td>{{$group->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{url('setups/student-group/edit/'.$group->id)}}"  type="button" class="btn btn-info mb-5">Edit</a>
                                    <a href="{{url('setups/student-group/delete/'.$group->id)}}" type="button" class="btn btn-danger mb-5" id="delete">Delete</a>
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
    <script type="text/javascript">
        $(document).ready(function () {
                $('#EditStudentClass').validate({
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

@endsection
