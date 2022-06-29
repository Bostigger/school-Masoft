<?php

namespace App\Http\Controllers\Backend\Students;

use App\Http\Controllers\Controller;
use App\Models\GradeMarks;
use Illuminate\Http\Request;

class StudentGradeController extends Controller
{
    public function ViewGradePage()
    {
        $data['all_grade'] = GradeMarks::all();
        return view('admin.student.marks.student-grade-view',$data);
    }

    public function AddGradePage()
    {
        return view('admin.student.marks.add-student-grade-page');
    }

    public function AddNewGrade(Request $request)
    {
        $new_grade = new GradeMarks;
        $new_grade->grade_name = $request->grade_name;
        $new_grade->grade_point = $request->grade_point;
        $new_grade->start_marks = $request->start_marks;
        $new_grade->end_marks = $request->end_marks;
        $new_grade->start_point = $request->start_point;
        $new_grade->end_point = $request->end_point;
        $new_grade->remarks = $request->remarks;
        $new_grade->save();

        $custome_msg = [
          'message'=>'Grade Successfully Added',
          'alert-type'=>'success',
        ];
        return redirect()->back()->with($custome_msg);
    }

    public function EditGradePage($id)
    {
        $data['selected_grade'] = GradeMarks::find($id);
        return view('admin.student.marks.edit-grade-page',$data);
    }

    public function UpdateGrade(Request $request,$id)
    {
        $selected_grade = GradeMarks::find($id);
        $selected_grade->grade_name = $request->grade_name;
        $selected_grade->grade_point = $request->grade_point;
        $selected_grade->start_marks = $request->start_marks;
        $selected_grade->end_marks = $request->end_marks;
        $selected_grade->start_point = $request->start_point;
        $selected_grade->end_point = $request->end_point;
        $selected_grade->remarks = $request->remarks;
        $selected_grade->save();
        $custome_msg = [
            'message'=>'Grade Successfully Updated',
            'alert-type'=>'success',
        ];
        return redirect()->back()->with($custome_msg);
    }

    public function DeleteGrade($id)
    {
        GradeMarks::find($id)->delete();

        $custome_msg = [
            'message'=>'Grade Successfully deleted',
            'alert-type'=>'warning',
        ];
        return redirect()->back()->with($custome_msg);
    }
}
