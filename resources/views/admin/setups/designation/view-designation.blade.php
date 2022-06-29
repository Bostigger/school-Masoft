@extends('admin.admin-master')
@section('admin')
    <br><div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Available Designations</h3>
                <a href="{{route('add.designation.page')}}" class="btn btn-rounded btn-info mb-5" style="float:right;">Add New Designation</a>
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

                        @foreach($designations as $key=> $designation)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$designation->name}}</td>
                                <td>{{$designation->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{url('setups/designate/edit/'.$designation->id)}}"  type="button" class="btn btn-info mb-5">Edit</a>
                                    <a href="{{url('setups/designate/delete/'.$designation->id)}}" type="button" class="btn btn-danger mb-5" id="delete">Delete</a>
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
