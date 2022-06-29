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
                        <h4 class="box-title">Generate Employee <strong>Attendance Report</strong></h4>
                    </div>
                    <div class="box-body">
                        <form action="{{route('get.employee.attendance.details')}}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Employees</label>
                                    <div class="controls">
                                        <select name="employee_id" id="employee_id" required class="form-control">
                                            <option value="" selected disabled>Select Employee</option>
                                            @foreach($all_employees as $emp)
                                                <option value="{{$emp->id}}">{{$emp->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    @error('employee_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="form-group">
                                            <input type="date" name="date" class="form-control">
                                        </div>
                                    </div>
                                    @error('date')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-primary mt-4" value="Proceed">
                                </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
