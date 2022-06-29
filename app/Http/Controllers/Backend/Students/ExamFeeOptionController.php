<?php

namespace App\Http\Controllers\Backend\Students;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\ExamType;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use PDF;

class ExamFeeOptionController extends Controller
{
    public function ExamFeeViewPage()
    {

        $data['student_years'] = StudentYear::all();
        $data['student_class'] = StudentClass::all();
        $data['exam_options'] = ExamType::all();
        return view('admin.student.exam_fee_option.exam-fee-view',$data);

    }

    public function FetchedExamType(Request $request)
    {

        $class_id = $request ->class_id;
        $year_id = $request ->year_id;
        $exam_type = $request ->exam_type;

        $data['all_students'] = AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->get();
        $data['selected_fee_amount'] = FeeCategoryAmount::where('fee_Category_id',2)->where('student_class_id',$class_id)->first();
        $data['selected_fee_name'] = ExamType::where('id',$exam_type)->first();

        return view('admin.student.exam_fee_option.fetched-exam-view',$data);

    }

    public function GenerateExamFeeSlip($student_id,$class_id,$name)
    {
        $data['exam_fee'] = FeeCategoryAmount::where('fee_category_id',2)->
        where('student_class_id',$class_id)->first();

        $data['selected_student'] = AssignStudent::where('student_id',$student_id)->where('class_id',$class_id)->first();
        //dd( $data['selected_student'])->toArrray();
        $pdf = PDF::loadView('admin.student.exam_fee_option.student-payslip', $data, compact('name'));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
