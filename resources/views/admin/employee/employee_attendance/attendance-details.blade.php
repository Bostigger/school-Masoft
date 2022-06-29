@extends('admin.admin-master')
@section('admin')
    <div class="row">
        <!--Bordery boxs!-->
       <div class="col-md-12">
           <div class="box-body">

                   <form action="{{route('update.attendance')}}" method="post">
                       @csrf
                       <input type="hidden" name="date" value="{{$selected_data[0]['date']}}">
                       <div class="box">
                           <div class="box-header with-border">
                               <h3 class="box-title">Attendance Details: <strong>{{$selected_data[0]['date']}}</strong></h3>
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

                                       @foreach($selected_data as $key=> $attend)
                                           <tr id="{{$attend->id}}">
                                               <input type="hidden" value="{{$attend->employee_id}}" name="employee_id[]">
                                               <td>{{$key+1}}</td>
                                               <td>{{$attend['userClass']['name']}}</td>
                                               <td colspan="3">
                                                   <div class="switch-toggle text-center switch-3 switch-candy">
                                                       <input type="radio" name="attend_status{{$key}}" value="present" {{($attend->attendance_status=='present')?'checked':''}} id="present{{$key}}">
                                                       <label for="present{{$key}}">Present</label>

                                                       <input type="radio" name="attend_status{{$key}}" value="leave" {{($attend->attendance_status=='leave')?'checked':''}} id="leave{{$key}}">
                                                       <label for="leave{{$key}}">Leave</label>

                                                       <input type="radio" name="attend_status{{$key}}"  value="absent" {{($attend->attendance_status=='absent')?'checked':''}} id="absent{{$key}}">
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
                           <input style="float: right" type="submit" class="btn btn-info" value="Update Attendance">

                       </div>
                   </form>


           </div>
       </div>
    </div>

@endsection
