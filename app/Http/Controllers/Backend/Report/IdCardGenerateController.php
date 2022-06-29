<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use PDF;

class IdCardGenerateController extends Controller
{
    public function GenerateIDPage()
    {
        $data['student_years'] = StudentYear::all();
        $data['student_classes'] = StudentClass::all();
        return view('admin.report.student-id-generate',$data);
    }

    public function GetGenerateIDPage(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        $check_availability = AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->first();

        if($check_availability){
            $data['selected_data'] =  AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->get();
            $pdf = PDF::loadView('admin.report.generate-student-id-card', $data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('generated_id_card.pdf');
        }else{
            $custom_msg = [
              'message' => 'Sorry No data Available',
              'alert-type' => 'error',
            ];
            return redirect()->back()->with($custom_msg);
        }
    }
}
