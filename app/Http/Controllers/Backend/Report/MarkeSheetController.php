<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\GradeMarks;
use App\Models\StudentClass;
use App\Models\StudentMarks;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class MarkeSheetController extends Controller
{
    public function ViewMarksSheetPage()
    {
        $data['student_years'] = StudentYear::all();
        $data['student_classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();
        return view('admin.report.view-marksheet-page',$data);
    }

    public function GetMarksSheetPage(Request $request)
    {
        $year_id = $request -> year_id;
        $class_id = $request -> class_id;
        $exam_type = $request -> exam_type;
        $student_id = $request -> id_no;

        $count_fails = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)
            ->where('exam_type_id',$exam_type)->where('id_no',$student_id)->where('marks','<','33')->get()->count();

        $selected_std = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)
            ->where('exam_type_id',$exam_type)->where('id_no',$student_id)->first();

        #$count_fails = StudentMarks::select('id_no')->groupBy('id_no')->get();

        if ($selected_std == true){
           $all_marks =  StudentMarks::with(['AssignSubjectClass','YearClass'])->where('year_id',$year_id)->where('class_id',$class_id)
               ->where('exam_type_id',$exam_type)->where('id_no',$student_id)->get();

            $all_grade = GradeMarks::all();

           return view('admin.report.mark-sheet-generate',compact('all_marks','count_fails','all_grade'));
        }else{

            $custom_msg = [
                'message'=>'Sorry No Such Data Available',
                'alert-type'=>'error',
            ];
            return redirect()->back()->with($custom_msg);
        }


    }
}
