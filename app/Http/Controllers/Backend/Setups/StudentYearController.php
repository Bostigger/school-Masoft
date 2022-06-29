<?php

namespace App\Http\Controllers\Backend\Setups;

use App\Http\Controllers\Controller;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentYearController extends Controller
{
    public function StudentYearPage()
    {
        $student_year = StudentYear::all();
        return view('admin.setups.studentyear.view-student-year',compact('student_year'));
    }

    public function AddStudentYearPage()
    {
        $student_year = StudentYear::all();
       return view('admin.setups.studentyear.add-student-year',compact('student_year'));
    }

    public function AddStudentYear(Request $request)
    {
        $request->validate([
           'name'=>'required|unique:student_years',
        ]);

        $new_student_year = new StudentYear;
        $new_student_year -> name = $request->name;
        $new_student_year ->save();

        $custom_msg = [
          'message'=>'Student Year Successfully Added',
          'alert-type'=>'success',
        ];
        return redirect()->back()->with($custom_msg);
    }

    public function EditStudentYear($id)
    {
        $student_year = StudentYear::all();
        $selected_year = StudentYear::find($id);
        return view('admin.setups.studentyear.edit-student-year',compact('selected_year','student_year'));
    }

    public function UpdateStudentYear(Request $request,$id)
    {
        $request->validate([
            'name'=>'required|unique:student_years',
        ]);
        StudentYear::find($id)->update([
           'name'=>$request->name,
        ]);
        $custom_msg = [
            'message'=>'Student Year Successfully Updated',
            'alert-type'=>'success',
        ];
        return redirect()->back()->with($custom_msg);
    }

    public function DeleteStudentYear($id)
    {
        StudentYear::find($id)->delete();
        $custom_msg = [
            'message'=>'Student Year Successfully Deleted',
            'alert-type'=>'warning',
        ];
        return redirect()->back()->with($custom_msg);
    }
}

