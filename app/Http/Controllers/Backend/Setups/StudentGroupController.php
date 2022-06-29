<?php

namespace App\Http\Controllers\Backend\Setups;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
{
    public function ViewStudentGroup()
    {
        $student_group = StudentGroup::all();
        return view('admin.setups.student_group.view-student-group',compact('student_group'));
    }

    public function AddStudentGroupPage()
    {
        $student_group = StudentGroup::all();
        return view('admin.setups.student_group.add-student-group',compact('student_group'));
    }

    public function AddStudentGroup(Request $request)
    {
        $request -> validate([
           'name'=>'required|unique:student_groups',
        ]);
        $new_student_group = new StudentGroup;
        $new_student_group ->name = $request -> name;
        $new_student_group ->save();

        $custome_msg = [
          'message'=>'Student Group Successfully Added',
          'alert-type'=>'success',
        ];

        return redirect()->back()->with($custome_msg);
    }

    public function EditStudentGroupPage($id)
    {
        $student_group = StudentGroup::all();
        $selected_group = StudentGroup::find($id);
        return view('admin.setups.student_group.edit-student-group',compact('selected_group','student_group'));
    }

    public function UpdateStudentGroup(Request $request,$id)
    {
     $request -> validate([
       'name'=>'required|unique:student_groups'
     ]);
     StudentGroup::find($id)->update([
        'name'=>$request->name,
     ]);

        $custome_msg = [
            'message'=>'Student Group Successfully Updated',
            'alert-type'=>'success',
        ];

        return redirect()->route('view.student.group')->with($custome_msg);

    }

    public function DeleteStudentGroup($id)
    {
        StudentGroup::find($id)->delete();
        $custome_msg = [
            'message'=>'Student Group Successfully deleted',
            'alert-type'=>'warning',
        ];

        return redirect()->back()->with($custome_msg);
    }
}
