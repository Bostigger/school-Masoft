@extends('admin.admin-master')
@section('admin')
    <div class="row">

    </div>
    <br><div class="col-12 mt-5 ">

        <form action="{{route('save.employee.attendance')}}" method="post">
            @csrf
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Mark Attendance</h3>
                </div>
                <div class="col-md-4 mt-5">
                    <label for="">Attendance Date</label>
                    <input type="date" name="date" required class="form-control">
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="table-responsive">
                        <table id="" class="table table-bordered table-striped" style="width: 100%">
                            <thead>
                            <tr>
                                <th  rowspan="2" class="text-center" style="vertical-align: middle;">SL</th>
                                <th rowspan="2" class="text-center" style="vertical-align: middle;">Name</th>
                                <th colspan="3" class="text-center" style="vertical-align: middle; width: 30%">Attendance Status</th>

                            </tr>
                            <tr>
                                <th class="text-center present_all">Present</th>
                                <th class="text-center leave_all">Leave</th>
                                <th class="text-center absent_all">Absent</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($all_employees as $key=> $employee)
                                <tr id="{{$employee->id}}">
                                    <input type="hidden" value="{{$employee->id}}" name="employee_id[]">
                                    <td>{{$key+1}}</td>
                                    <td>{{$employee ->  name}}</td>
                                    <td colspan="3">
                                        <div class="switch-toggle text-center switch-3 switch-candy">
                                            <input type="radio" name="attend_status{{$key}}" value="present" checked id="present{{$key}}">
                                            <label for="present{{$key}}">Present</label>

                                            <input type="radio" name="attend_status{{$key}}" value="leave" id="leave{{$key}}">
                                            <label for="leave{{$key}}">Leave</label>

                                            <input type="radio" name="attend_status{{$key}}"  value="absent" id="absent{{$key}}">
                                            <label for="absent{{$key}}">Absent</label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
               <div>
                   <input style="float: right" type="submit" class="btn btn-info" value="Mark Attendance">

               </div>
        </form>
        <!-- /.box -->
        <br> <br>
      <div>
          <h3>Recent Attendances</h3>
          <table class="table table-bordered table-striped" style="width: 100%">
              <thead>
              <tr>

                  <th rowspan="2">SL</th>
                  <th rowspan="2">Date</th>
                  <th rowspan="3">Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($all_attendance_data as $key=> $attend)
              <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$attend->date}}</td>
                  <td>
                      <a href="{{url('employees/view-attendance/'.$attend->date)}}" class="btn btn-primary">View</a>
                      <a href="{{url('employees/delete-attendance/'.$attend->date)}}" id="delete" class="btn btn-danger">Delete</a>
                      <a href="{{url('employees/export-attendance/'.$attend->date)}}" class="btn btn-primary">Export</a>
                  </td>
              </tr>
              @endforeach
              </tbody>
          </table>
      </div>
        <!-- /.box -->
    </div>
@endsection
