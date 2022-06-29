<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAccountSalary;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeAccountSalaryController extends Controller
{
    public function ViewEmployeeAccountSalary()
    {
        $data['all_employee_salary_payments'] = EmployeeAccountSalary::all();
        return view('admin.account.employee.employee-salary-payment-page',$data);
    }

    public function SalaryPaymentPage()
    {
        $data['all_employees'] = User::where('usertype','Employee')->get();
       # dd($data['all_employees'])->toArray();
        return view('admin.account.employee.select-employee-details',$data);
    }

    public function FetchEmployeeDetails(Request $request)
    {
        $date = $request->date;
        $data['employees_data'] = EmployeeAttendance::select('employee_id')->groupby('employee_id')->where('date',$date)->get();
        #dd($data['employees_data'])->toArray();
        return view('admin.account.employee.employee-salary-details-page',$data, compact('date'));
    }

    public function InsertEmployeePaymentDetails(Request $request)
    {
        EmployeeAccountSalary::where('date',$request->date)->delete();

         $count_fields = count($request->check_manage);
         if ($count_fields!=null){
             for ($i=0; $i<$count_fields; $i++){
                 $employee_payment = new EmployeeAccountSalary;
                 $employee_payment -> employee_id = $request->employee_id[$i];
                 $employee_payment -> date = $request -> date;
                 $employee_payment -> amount = $request->amount[$i];
                 $employee_payment -> save();
             }
         }

         $custome_msg = [
             'message'=>'Successfully Updated employee payment details',
             'alert-type'=>'info',
         ];
         return redirect()->route('view.employee.account.salary')->with($custome_msg);

    }
}
