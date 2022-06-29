<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeSalary;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    public function ManageSalaryPage()
    {
        $data['all_employees'] = User::where('usertype','Employee')->get();
        return view('admin.employee.employee_salary.manage-salary-page',$data);
    }

    public function ViewEmployeeSalaryPage($id)
    {
       $data['selected_employee'] = EmployeeSalary::where('employee_id',$id)->first();
       return view('admin.employee.employee_salary.view-employee-salary',$data);
    }

    public function UpdateSalary(Request $request,$employee_id)
    {
        $increase_percentage = $request -> increase_percent;

        $increment = (float)($request->salary) * ($increase_percentage/100);
        $final_salary = $request -> salary + $increment;

        $update_emp_salary = EmployeeSalary::where('employee_id',$employee_id)->first()->update([
            'previous_salary'=>$request->salary,
            'present_salary'=>$final_salary,
            'incremented_salary'=>$final_salary,
            'effected_date'=>date('y-m-d',strtotime($request->effected_date)),
        ]);


        $update_user_salary = User::where('id',$employee_id)->first()->update([
            'salary'=>$final_salary
        ]);


        $notification = [
          'message'=>'Successfully Updated Employee Salary',
          'alert-type'=>'success',
        ];

        return redirect()->back()->with($notification);


    }
}
