@extends('admin.admin-master')
@section('admin')
    <br><div class="col-12 mt-5 ">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Fee Category Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <h4>Fee Category:  {{$selected_category[0]['FeeCategory']['name'] }}</h4>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Student Class</th>
                            <th>Fee Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($selected_category as $key=> $category)
                            <tr>
                                <th scope="row">{{$key++}}</th>
                                <td>{{$category['ClassName']['name']}}</td>
                                <td>{{$category->fee_amount}}</td>
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
