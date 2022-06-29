<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class AttendanceController extends Controller
{
    public function ViewEmployeeAttendanceReportPage()
    {
        $data['all_employees'] = User::where('usertype','Employee')->get();
        #dd($data['all_employees']->toArray());
        return view('admin.report.employee-attendance-report-page',$data);
    }

    public function GetEmployeeAttendanceDetails(Request $request)
    {
        $employee = $request -> employee_id;
        $date = date('Y-m',strtotime($request->date));

        $selected_employee = EmployeeAttendance::with(['userClass'])->where('employee_id',$employee)
            ->where('date','like',$date.'%')->first();

        $data['number_of_attendance'] = EmployeeAttendance::where('employee_id',$employee)
            ->where('date','like',$date.'%')->get()->count();

       if ($selected_employee){
           $data['all_data'] = EmployeeAttendance::with(['userClass'])->where('employee_id',$employee)
               ->where('date','like',$date.'%')->get();
           $data['number_of_absents'] = EmployeeAttendance::with(['userClass'])->where('employee_id',$employee)
               ->where('date','like',$date.'%')->where('attendance_status','absent')->get()->count();

           $data['number_of_presents'] = EmployeeAttendance::with(['userClass'])->where('employee_id',$employee)
               ->where('date','like',$date.'%')->where('attendance_status','present')->get()->count();

           $data['number_of_leaves'] = EmployeeAttendance::with(['userClass'])->where('employee_id',$employee)
               ->where('date','like',$date.'%')->where('attendance_status','leave')->get()->count();

           $data['date'] = date('Y-m',strtotime($request->date));

           $pdf = PDF::loadView('admin.report.export-attendance', $data);
           $pdf->SetProtection(['copy', 'print'], '', 'pass');
           return $pdf->stream('attendance-report.pdf');

       }else{
           $custom_msg = [
             'message'=>'Sorry No data available',
             'alert-type'=>'error',
           ];

           return redirect()->back()->with($custom_msg);
       }
    }
}
