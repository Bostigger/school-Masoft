@extends('admin.admin-master')
@section('admin')
    <br><div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Fee Category Amount</h3>
                <a href="{{route('add.fee.amount.page')}}" class="btn btn-rounded btn-info mb-5" style="float:right;">Add Fee Category Amount</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fee Category</th>
                            <th>Created At</th>
                            <th>Actions</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($fee_cat_amount as $key=> $category_amount)
                            <tr>
                                <th scope="row">{{$key++}}</th>
                                <td>{{$category_amount['FeeCategory']['name']}}</td>
                                <td>{{$category_amount->created_at}}</td>
                                <td>
                                    <a href="{{url('setups/fee-category-amount/edit/'.$category_amount->fee_category_id)}}"  type="button" class="btn btn-info mb-5">Edit</a>
                                    <a href="{{url('setups/fee-category-amount/details/'.$category_amount->fee_category_id)}}" type="button" class="btn btn-secondary mb-5" id="">View Details</a>
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
