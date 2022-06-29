<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class EmployeeAttendanceController extends Controller
{
    public function ViewAttendancePage()
    {
        $data['all_attendance_data'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id','desc')->get();
        $data['all_employees'] = User::where('usertype','Employee')->get();
        return view('admin.employee.employee_attendance.view-attendance',$data);
    }

    public function UpdateAttendance(Request $request)
    {

           $count_employee = count($request->employee_id);
            for ($i=0; $i<$count_employee; $i++){
                $attend_status = 'attend_status'.$i;

                $new_attendance = new EmployeeAttendance;
                $new_attendance -> employee_id = $request->employee_id[$i];
                $new_attendance -> attendance_status = $request->$attend_status;
                $new_attendance -> date = date('y-m-d',strtotime($request->date));
                $new_attendance -> save();

        }
        $msg = [
          'message'=>'Successfully Marked Attendance',
          'alert-type'=>'success',
        ];

        return redirect()->back()->with($msg);
    }

    public function ViewAttendance($date)
    {
        $data['selected_data'] = EmployeeAttendance::where('date',$date)->get();

        return view('admin.employee.employee_attendance.attendance-details',$data);
    }

    public function UpdateEmployeeAttendance(Request $request)
    {
        EmployeeAttendance::where('date',date('y-m-d',strtotime($request->date)))->delete();

        $count_employee = count($request->employee_id);
        for ($i=0; $i<$count_employee; $i++){
            $attend_status = 'attend_status'.$i;

            $new_attendance = new EmployeeAttendance;
            $new_attendance -> employee_id = $request->employee_id[$i];
            $new_attendance -> attendance_status = $request->$attend_status;
            $new_attendance -> date = date('y-m-d',strtotime($request->date));
            $new_attendance -> save();

        }
        $msg = [
            'message'=>'Successfully Marked Attendance',
            'alert-type'=>'success',
        ];

        return redirect()->back()->with($msg);

    }

    public function DeleteAttendance($date)
    {
        EmployeeAttendance::where('date',$date)->delete();
        $msg = [
            'message'=>'Successfully Deleted Attendance',
            'alert-type'=>'error',
        ];

        return redirect()->back()->with($msg);
    }

    public function ExportAttendance($date)
    {
       $data['selected_date'] = EmployeeAttendance::where('date',$date)->get();
        $pdf = PDF::loadView('admin.employee.employee_attendance.export-attendance', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
