<?php

namespace App\Http\Controllers\Backend\Students;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use PDF;

class StudentRegistrationFeeController extends Controller
{
    public function StudentReFeePage()
    {
        $data['student_years'] = StudentYear::all();
        $data['student_class'] = StudentClass::all();

        return view('admin.student.registration_fee.student-registration-fee',$data);
    }

    public function GetRegFeesData(Request $request)
    {
        $year_id = $request -> year_id;
        $class_id = $request -> class_id;

        $data['all_students'] = AssignStudent::with(['studentDiscount'])
            ->where('year_id',$year_id)->where('class_id',$class_id)->get();

        $data['registration_fee'] = FeeCategoryAmount::where('fee_category_id','3')->
        where('student_class_id',$class_id)->first();

        return view('admin.student.registration_fee.student-fees',$data);

    }


    public function GeneratePaySlip($student_id,$class_id)
    {
        $data['registration_fee'] = FeeCategoryAmount::where('fee_category_id','3')->
        where('student_class_id',$class_id)->first();

        $data['selected_student'] = AssignStudent::where('student_id',$student_id)->where('class_id',$class_id)->first();
        //dd( $data['selected_student'])->toArrray();
        $pdf = PDF::loadView('admin.student.registration_fee.student-payslip.blade.php', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
