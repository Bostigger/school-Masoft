<?php

namespace App\Http\Controllers\Backend\Setups;

use App\Http\Controllers\Controller;
use App\Models\StudentShift;
use Illuminate\Http\Request;

class StudentShiftController extends Controller
{
    public function ViewStudentShiftPage()
    {
        $student_shift = StudentShift::all();
        return view('admin.setups.student_shift.view-student-shift',compact('student_shift'));
    }

    public function AddStudentShiftPage()
    {
        $student_shift = StudentShift::all();
        return view('admin.setups.student_shift.add-student-shift',compact('student_shift'));
    }

    public function AddStudentShift(Request $request)
    {
        $request -> validate([
           'name'=>'required|unique:student_shifts'
        ]);
        $new_shift = new StudentShift;
        $new_shift -> name = $request -> name;
        $new_shift -> save();

        $custome_msg = [
          'message'=>'Student Successfully Inserted',
          'alert-type'=>'success',
        ];
        return redirect()->back()->with($custome_msg);
    }

    public function EditStudentShift($id)
    {
        $student_shift = StudentShift::all();
        $selected_shift = StudentShift::find($id);
        return view('admin.setups.student_shift.edit-student-shift',compact('selected_shift','student_shift'));
    }

    public function UpdateStudentShift(Request $request,$id)
    {
        $request -> validate([
           'name'=>'required|unique:student_shifts'
        ]);
        StudentShift::find($id)->update([
           'name'=>$request -> name,
        ]);

        $custome_msg = [
            'message'=>'Student Successfully Updated',
            'alert-type'=>'success',
        ];
        return redirect()->route('view.student.shift')->with($custome_msg);
    }

    public function DeleteStudentShift($id)
    {
        StudentShift::find($id)->delete();
        $custome_msg = [
            'message'=>'Student Successfully Deleted',
            'alert-type'=>'warning',
        ];
        return redirect()->back()->with($custome_msg);
    }
}
