@extends('admin.admin-master')
@section('admin')
    <div class="row">
        <!--Bordery boxs!-->

    </div>
    <br><div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Other Costs</h3>
                <a href="{{route('add.other.cost.page')}}" class="btn btn-rounded btn-info mb-5" style="float:right;">Add New Cost</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($all_other_costs as $key=> $cost)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{date('y-m',strtotime($cost->date))}}</td>
                                <td>{{$cost->amount}}</td>
                                <td>{{$cost->description}}</td>
                                <td><img src="{{asset($cost->image)}}"  style="width: 50px; height: 50px" alt=""> </td>
                                <td>
                                    <a href="{{url('accounts/other-cost/edit/'.$cost->id)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                    <a href="{{url('accounts/other-cost/delete/'.$cost->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- /.box -->


        <!-- /.box -->
    </div>
@endsection
