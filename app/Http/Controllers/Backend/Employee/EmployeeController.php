<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\EmployeeSalary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDF;

class EmployeeController extends Controller
{
    public function ViewAllEmployees()
    {
        $data['all_employees'] = User::where('usertype','Employee')->get();

       # dd($data['all_employees'])->toArray();
        return view('admin.employee.view-employees',$data);
    }

    public function AddEmpPage()
    {
        $data['designations'] = Designation::all();

        return view('admin.employee.add-employee',$data);
    }

    public function AddEmployeeDetails(Request $request)
    {
       DB::transaction(function () use($request){
           //generate Id for employee
           $join_year =date('Ym',strtotime($request->join_date));
           $employee = User::where('usertype','Employee')->orderBy('id','desc')->first();
           if($employee==null){
               $firstReg = 0;
               $employee_id = $firstReg + 1;
               if($employee_id < 10){
                   $id_no = '000'.$employee_id;
               }elseif ($employee_id < 100){
                   $id_no = '00'.$employee_id;
               }elseif ($employee_id < 1000){
                   $id_no = '0'.$employee_id;
               }
           }else{
               $employee = User::where('usertype','Employee')->orderBy('id','desc')->first()->id;
               $employee_id = $employee + 1;
               if($employee_id < 10){
                   $id_no = '000'.$employee_id;
               }elseif ($employee_id < 100){
                   $id_no = '00'.$employee_id;
               }elseif ($employee_id < 1000){
                   $id_no = '0'.$employee_id;
               }
           }
           $final_id = $join_year.$id_no;
           $code = rand(0000,9999);
           $new_employee = new User;
           $new_employee -> name = $request -> name;
           $new_employee -> fname = $request -> fname;
           $new_employee -> mname = $request -> mname;
           $new_employee -> mobile = $request -> mobile;
           $new_employee -> address = $request -> address;
           $new_employee -> gender = $request -> gender;
           $new_employee -> code = $code;
           $new_employee -> id_no = $final_id;
           $new_employee -> password = Hash::make($code);
           $new_employee -> usertype = 'Employee';
           $new_employee -> religion = $request -> religion;
           $new_employee -> dob = date('y-m-d',strtotime($request->dob));
           $new_employee -> join_date =date('y-m-d',strtotime($request->join_date));
           $new_employee -> salary = $request -> salary;
           $new_employee -> designation_id = $request -> designation_id;
          if($request->file('image')){
              $profile_image = $request->file('image');
              $unique_name = hexdec(uniqid()).'.'.$profile_image->getClientOriginalExtension();
              $photo_loc = 'employee/images/';
              $profile_image->move($photo_loc,$unique_name);
              $save_img = $photo_loc.$unique_name;
              $new_employee->image = $save_img;
          }
          $new_employee->save();

          $new_salary_record = new EmployeeSalary;
          $new_salary_record -> employee_id = $new_employee->id;
          $new_salary_record -> previous_salary= $request->salary;
          $new_salary_record -> present_salary= $request->salary;
          $new_salary_record -> incremented_Salary= '0';
          $new_salary_record -> effected_date= date('y-m-d',strtotime($request->join_date));
          $new_salary_record->save();

       });
        $custome_msg = [
            'message'=>'Employee Successfully Registered',
            'alert-type'=>'success',
        ];
        return redirect()->back()->with($custome_msg);
    }

    public function EditEmployeePage($id)
    {
        $data['selected_emp'] = User::find($id);
        $data['all_desig'] = Designation::all();
        return view('admin.employee.edit-employee',$data);
    }

    public function UpdateEmployeeDetails(Request $request,$id)
    {
        DB::transaction(function () use ($request, $id) {

            if ($request->file('image')) {
                $img = $request->file('image');
                $unique_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                $img_loc = 'employee/images/';
                $img->move($img_loc,$unique_name);
                $save_img = $img_loc.$unique_name;
                $old_file = $request ->old_image;
                if (!empty($old_file)){
                    unlink($old_file);
                }


                $update_emp = User::where('id',$id)->first();
                    $update_emp -> name = $request->name;
                    $update_emp -> fname = $request->fname;
                    $update_emp -> mname = $request->mname;
                    $update_emp -> mobile = $request->mobile;
                    $update_emp -> address = $request->address;
                    $update_emp -> gender = $request->gender;
                    $update_emp -> religion = $request->religion;
                    $update_emp -> dob =date('y-m-d', strtotime($request->dob));
                    $update_emp -> join_date = date('y-m-d', strtotime($request->join_date));
                    $update_emp -> salary = $request->salary;
                    $update_emp -> image = $save_img;
                    $update_emp -> save();


            } else {
                $update_emp = User::where('id',$id)->first();
                $update_emp -> name = $request->name;
                $update_emp -> fname = $request->fname;
                $update_emp -> mname = $request->mname;
                $update_emp -> mobile = $request->mobile;
                $update_emp -> address = $request->address;
                $update_emp -> gender = $request->gender;
                $update_emp -> religion = $request->religion;
                $update_emp -> dob =date(strtotime('y-m-d', $request->dob));
                $update_emp -> join_date = date(strtotime('y-m-d', $request->join_date));
                $update_emp -> salary = $request->salary;
                $update_emp -> save();
            }



        });

        $update_sal = EmployeeSalary::where('employee_id',$id)->update([
          'previous_salary' => $request->salary,
          'present_salary' => $request->salary
        ]);
        $custome_msg = [
            'message' => 'Employee Successfully Updated',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($custome_msg);

    }

    public function GetEmployeeDetails($id)
    {

        $data['selected_employee'] = User::find($id);
        $pdf = PDF::loadView('admin.employee.employee_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('employee_details.pdf');
    }

    public function DeleteEmployee($id)
    {
        $employee=User::find($id);
        if(!empty($employee->image)){
            unlink($employee->image);
        }
        $employee->delete();


        EmployeeSalary::where('employee_id',$id)->delete();
        $custome_msg = [
            'message' => 'Employee Successfully Deleted',
            'alert-type' => 'warning',
        ];
        return redirect()->back()->with($custome_msg);

    }
}
