<?php

namespace App\Http\Controllers\Backend\Setups;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    public function ViewExamType()
    {
        $exam_types = ExamType::all();
        return view('admin.setups.exam_type.view-exam-type',compact('exam_types'));
    }

    public function AddExamTypePage()
    {
        $exam_types = ExamType::all();
        return view('admin.setups.exam_type.add-exam-type',compact('exam_types'));
    }

    public function AddExamType(Request $request)
    {
        $request -> validate([
           'name'=>'required|unique:exam_types'
        ]);
        $new_exam_type = new ExamType;
        $new_exam_type -> name = $request -> name;
        $new_exam_type -> save();

        $notification = [
          'message'=>'Exam type successfully inserted',
          'alert-type'=>'success',
        ];

        return redirect()->route('view.exam.type')->with($notification);
    }

    public function EditExamTypePage($id)
    {
        $selected_exam_type = ExamType::find($id);
        $exam_types = ExamType::all();
        return view('admin.setups.exam_type.edit-exam-type',compact('selected_exam_type','exam_types'));
    }

    public function UpdateExamTypePage(Request $request, $id)
    {
        $request -> validate([
            'name'=>'required|unique:exam_types'
        ]);
        ExamType::find($id)->update([
           'name'=>$request -> name,
        ]);
        $notification = [
            'message'=>'Exam type successfully updated',
            'alert-type'=>'success',
        ];

        return redirect()->route('view.exam.type')->with($notification);
    }

    public function DeleteExamType($id)
    {
        ExamType::find($id)->delete();
        $notification = [
            'message'=>'Exam type successfully deleted',
            'alert-type'=>'Warning',
        ];

        return redirect()->route('view.exam.type')->with($notification);
    }
}
