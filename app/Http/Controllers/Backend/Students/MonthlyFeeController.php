<?php

namespace App\Http\Controllers\Backend\Students;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use PDF;

class MonthlyFeeController extends Controller
{
    public function ChooseMonthPage()
    {

        $data['student_years'] = StudentYear::all();
        $data['student_class'] = StudentClass::all();

        return view('admin.student.monthly_fee.student-monthly-fees',$data);
    }

    public function SelectMonthFeePage(Request $request)
    {
        $year_id = $request -> year_id;
        $class_id = $request -> class_id;
        $data['selected_month'] = $request -> month;
        $data['all_students'] = AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->get();

        $data['monthly_fee'] = FeeCategoryAmount::where('fee_category_id',4)->where('student_class_id',$class_id)->first();
        #dd($data['monthly_fee'])->toArray();
        return view('admin.student.monthly_fee.fetched-monthly-fee',$data);
    }

    public function GenerateMonthFeePayslip($student_id,$class_id,$selected_month)
    {
        $data['monthly_fee'] = FeeCategoryAmount::where('fee_category_id','4')->
        where('student_class_id',$class_id)->first();

        $data['selected_student'] = AssignStudent::where('student_id',$student_id)->where('class_id',$class_id)->first();
        //dd( $data['selected_student'])->toArrray();
        $pdf = PDF::loadView('admin.student.monthly_fee.student-payslip', $data, compact('selected_month'));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
