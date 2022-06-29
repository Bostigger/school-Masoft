<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class EmployeeMonthlySalaryController extends Controller
{

    public function FetchEmployees()
    {

       $data['all_employees'] = User::where('usertype','Employee')->get();
        return view('admin.employee.employee_monthly_salary.fetch-employee-monthly-salary',$data);
    }

    public function GetEmployeesMonthlySalary($id)
    {

      $selected_data = EmployeeAttendance::where('employee_id',$id)->get();
      $data['selected_employee'] = EmployeeAttendance::where('employee_id',$id)->first();
      $data['count_absent'] = count($selected_data->where('attendance_status','absent'));

      return view('admin.employee.employee_monthly_salary.employee-monthly-salary',$data);

    }

    public function GenerateSlip(Request $request,$id)
    {
        $data['selected_employee'] = EmployeeAttendance::where('employee_id',$id)->first();
        $selected_data = EmployeeAttendance::where('employee_id',$id)->get();
        $data['count_absent'] = count($selected_data->where('attendance_status','absent'));

        $data['date'] = date('F-Y',strtotime($request ->date));

        $pdf = PDF::loadView('admin.employee.employee_monthly_salary.employee-salary-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('employee_Salary.pdf');
    }


}
