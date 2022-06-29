<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeave;
use App\Models\EmployeeLeavePurpose;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeLeaveController extends Controller
{
    public function ViewEmpLeavePage()
    {
        $data['all_leave_data'] = EmployeeLeave::all();
        return view('admin.employee.employee_leave.view-employee-leave',$data);
    }

    public function AddLeavePurposePage()
    {
        $data['all_leave_purposes'] = EmployeeLeavePurpose::all();
        return view('admin.employee.employee_leave.add-leave-page',$data);
    }

    public function AddNewLeavePage()
    {
        $data['all_leave_purposes'] = EmployeeLeavePurpose::all();
        $data['all_employees'] = User::where('usertype','Employee')->get();
        return view('admin.employee.employee_leave.add-new-leave-page',$data);
    }


    public function AddNewLeave(Request $request)
    {
        DB::transaction(function () use ($request){
            if ($request->leave_purpose_id=='0'){
                $new_purpose = new EmployeeLeavePurpose;
                $new_purpose -> leave_purpose = $request->new_purpose;
                $new_purpose -> save();
                $leave_purpose_id = $new_purpose ->id;
            }else{
                $leave_purpose_id = $request -> leave_purpose_id;
            }
            $new_leave = new EmployeeLeave;
            $new_leave -> employee_id = $request ->employee_id;
            $new_leave -> leave_purpose_id = $leave_purpose_id;
            $new_leave -> start_date = $request ->start_date;
            $new_leave -> end_date = $request ->end_date;
            $new_leave -> save();


        });

        $message = [
            'message'=>'Leave Successfully Added',
            'alert-type'=>'success',
        ];
        return redirect()->back()->with($message);
    }

    public function EditEmployeeLeavePage($id)
    {
        $data['all_leave_purposes'] = EmployeeLeavePurpose::all();
        $data['all_employees'] = User::where('usertype','Employee')->get();
        $data['selected_leave']  = EmployeeLeave::find($id);
        return view('admin.employee.employee_leave.edit-employee-leave',$data);
    }

    public function UpdateEmployeeLeave(Request $request,$id)
    {
        DB::transaction(function ()use($request,$id){
            $selected_leave = EmployeeLeave::find($id);
            $selected_leave  -> employee_id = $request ->employee_id;
            $selected_leave  -> leave_purpose_id = $request ->leave_purpose_id;
            $selected_leave -> start_date = $request ->start_date;
            $selected_leave  -> end_date = $request ->end_date;
            $selected_leave  -> save();
        });

        $message = [
            'message'=>'Leave Successfully updated',
            'alert-type'=>'success',
        ];
        return redirect()->back()->with($message);

    }

    public function AddLeavePurpose(Request $request)
    {
        DB::transaction(function () use($request){
            $request->validate([
                'leave_purpose'=>'required|unique:employee_leave_purposes',
            ]);
            $new_leave_purpose = new EmployeeLeavePurpose;
            $new_leave_purpose -> leave_purpose = $request->leave_purpose;
            $new_leave_purpose->save();
        }) ;

        $message = [
          'message'=>'Leave Purpose Successfully Added',
          'alert-type'=>'success',
        ];
        return redirect()->back()->with($message);
    }

    public function DeleteEmployeeLeave($id)
    {
        EmployeeLeave::find($id)->delete();
        $message = [
            'message'=>'Leave Purpose Successfully Deleted',
            'alert-type'=>'error',
        ];
        return redirect()->back()->with($message);
    }

}
