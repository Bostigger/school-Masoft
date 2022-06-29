<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentMarks;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use PDF;
class ResultsController extends Controller
{
    public function ViewResultsGeneratePage()
    {
        $data['student_years'] = StudentYear::all();
        $data['student_classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();
        return view('admin.report.students-result-generate',$data);
    }

    public function GetStudentsDetails(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type= $request->exam_type;

        $data = StudentMarks::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type)->first();

        if ($data){
            $data['selected_data'] = StudentMarks::select('year_id','class_id','exam_type_id','student_id')
                ->where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type)
                ->groupBy('year_id')->groupBy('class_id')->
                groupBy('exam_type_id')->groupBy('student_id')->get();


            #dd($data['selected_data'])->toArray();
            $pdf = PDF::loadView('admin.report.export-results', $data,compact('class_id'));
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('student-results.pdf');

        }$custom_msg = [
        'message' => 'Sorry No data Available',
        'alert-type' => 'error',
    ];
        return redirect()->back()->with($custom_msg);


    }
}
