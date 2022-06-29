<?php

namespace App\Http\Controllers\Backend\Students;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\AssignSubject;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentMarks;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    public function AddMarksPage()
    {
        $data['student_years'] = StudentYear::all();
        $data['student_classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();
        return view('admin.student.marks.student-marks-page',$data);
    }

    public function GetSubjects(Request $request)
    {
        $class_id = $request->class_id;
        $all_classes = AssignSubject::with(['SubjectClass'])->where('student_class_id',$class_id)->get();
        return response()->json($all_classes);
    }

    public function FetchDetails(Request $request)
    {
        $class_id = $request -> class_id;
        $year_id = $request -> year_id;

        $data = AssignStudent::with(['userClass'])->where('year_id',$year_id)->where('class_id',$class_id)->get();
        return response()->json($data);
    }

    public function InsertStudentMarks(Request $request)
    {

        $count_marks = count($request->marks);
        if($count_marks!=null){
            for ($i=0; $i<$count_marks; $i++){
                $new_marks = new StudentMarks;
                $new_marks -> student_id = $request -> student_id[$i];
                $new_marks -> id_no = $request -> id_no[$i];
                $new_marks -> year_id = $request -> year_id;
                $new_marks -> class_id = $request -> class_id;;
                $new_marks -> assign_subject_id = $request -> assign_subject_id;
                $new_marks -> exam_type_id = $request -> exam_type_id;
                $new_marks -> marks = $request->marks[$i];
                $new_marks -> save();
            }
            $custom_msg = [
                'message'=>'Student Marks Successfully Inserted',
                'alert-type'=>'success',
            ];
            return redirect()->back()->with($custom_msg);
        }
        $custom_msg = [
            'message'=>'Student Marks not Provided!',
            'alert-type'=>'error',
        ];
        return redirect()->back()->with($custom_msg);


    }

    public function UpdateStudentMarks()
    {
        $data['student_years'] = StudentYear::all();
        $data['student_classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();
        return view('admin.student.marks.student-marks-update',$data);
    }

    public function GetStudentMarks(Request $request)
    {
        $class_id = $request -> class_id;
        $year_id = $request -> year_id;
        $assign_subject_id = $request -> assign_subject_id;
        $exam_type_id = $request ->exam_type_id;
        $student_marks = StudentMarks::with(['userClass'])->where('class_id',$class_id)
            ->where('year_id',$year_id)->where('assign_subject_id',$assign_subject_id)->
            where('exam_type_id',$exam_type_id)
            ->get();
        return response()->json($student_marks);
    }

    public function UpdateStudentsMark(Request $request)
    {
        $class_id = $request -> class_id;
        $year_id = $request -> year_id;
        $assign_subject_id = $request -> assign_subject_id;
        $exam_type_id = $request ->exam_type_id;
        StudentMarks::where('class_id',$class_id)
            ->where('year_id',$year_id)->where('assign_subject_id',$assign_subject_id)->
            where('exam_type_id',$exam_type_id)->delete();

        $count_marks = count($request->marks);
        if($count_marks!=null){
            for ($i=0; $i<$count_marks; $i++){
                $new_marks = new StudentMarks;
                $new_marks -> student_id = $request -> student_id[$i];
                $new_marks -> id_no = $request -> id_no[$i];
                $new_marks -> year_id = $request -> year_id;
                $new_marks -> class_id = $request -> class_id;;
                $new_marks -> assign_subject_id = $request -> assign_subject_id;
                $new_marks -> exam_type_id = $request -> exam_type_id;
                $new_marks -> marks = $request->marks[$i];
                $new_marks -> save();
            }
            $custom_msg = [
                'message'=>'Student Marks Successfully Inserted',
                'alert-type'=>'success',
            ];
            return redirect()->back()->with($custom_msg);
        }
        $custom_msg = [
            'message'=>'Student Marks not Provided!',
            'alert-type'=>'error',
        ];
        return redirect()->back()->with($custom_msg);
    }
}
