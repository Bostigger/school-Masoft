@extends('admin.admin-master')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.min.js"></script>
    <div class="row">
        <!--Bordery boxs!-->
        <div  class="box-body">
            <div class="col-md-12">
                <div class="box bb-3 border-warning">
                    <div class="box-header">
                        <h4 class="box-title">Choose <strong>Monthly Date</strong></h4>
                    </div>
                    <div class="box-body">
                        <form action="" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Date</label>
                                        <div class="form-group">
                                             <input type="date" name="date" class="form-control">
                                        </div>
                                    </div>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror

                                    <input type="submit" class="btn btn-primary mt-4" value="Proceed">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!--Bordery boxs!-->
        <div  class="box-body">
            <div class="col-md-12">
                <div class="box bb-3 border-warning">
                    <div class="box-header">
                        <h4 class="box-title">Employee <strong>Monthly Fee</strong></h4>
                    </div>
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>ID No</th>
                                        <th>Monthly Salary</th>
                                        <th>Due Salary</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($all_employees as $key=> $employee)

                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$employee->name}}</td>
                                            <td>{{$employee->id_no}}</td>
                                            <td>{{$employee->salary}}</td>
                                            <td>
                                                <a href="{{url('employees/salary/due-monthly/'.$employee->id)}}" class="btn btn-secondary">Monthly Salary</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
