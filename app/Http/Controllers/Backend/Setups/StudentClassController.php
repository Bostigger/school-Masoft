<?php

namespace App\Http\Controllers\Backend\Setups;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    public function ViewStudentClass()
    {
        $student_class = StudentClass::latest()->paginate(10);
       return view('admin.setups.view-student-class',compact('student_class'));
    }

    public function AddStudentClassPage()
    {
        $student_class = StudentClass::latest()->paginate(10);
        return view('admin.setups.add-student-class',compact('student_class'));
    }

    public function AddStudentClass(Request $request)
    {
        $request->validate([
           'name'=>'required|unique:student_classes'
        ]);
        $new_class = new StudentClass;
        $new_class->name=$request->name;
        $new_class->save();

        $custome_message = [
          'message'=>'Student Class Successfully Added',
          'alert-type'=>'success',
        ];
        return redirect()->back()->with($custome_message);
    }

    public function EditClassPage($id)
    {
        $student_class = StudentClass::latest()->paginate(10);
        $selected_class = StudentClass::find($id);
        return view('admin.setups.edit-student-class',compact('selected_class','student_class'));
    }
    public function UpdateStudentClass(Request $request,$id)
    {

        StudentClass::find($id)->update([
           'name'=>$request->name,
        ]);
        $custome_message = [
            'message'=>'Student Class Successfully updated',
            'alert-type'=>'success',
        ];
        return redirect()->back()->with($custome_message);
    }

    public function DeleteStudentClass($id)
    {
        StudentClass::find($id)->delete();
        $custome_message = [
            'message'=>'Student Class Successfully updated',
            'alert-type'=>'warning',
        ];
        return redirect()->back()->with($custome_message);
    }
}
