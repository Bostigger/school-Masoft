<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use App\Models\StudentFee;
use App\Models\StudentYear;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentFeeController extends Controller
{
    public function ViewStudentFee()
    {
        $data['all_student_fees'] = StudentFee::all();
        return view('admin.account.student.view-student-fee',$data);
    }

    public function AddStudentFeePage()
    {
        $data['student_years'] = StudentYear::all();
        $data['student_class'] = StudentClass::all();
        $data['all_categories'] = FeeCategory::all();
        return view('admin.account.student.add-student-fee-page',$data);
    }

    public function FetchStudentDetails(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request ->class_id;
        $data['fee_category_id'] = $request ->fee_category_id;
        $data['date'] = $request ->date;
        $data['selected_students'] = AssignStudent::where('class_id',$class_id)
            ->where('year_id',$year_id)->get();

       #( $data['selected_students'])->toArray();
        return view('admin.account.student.fetched-student-fees',$data,compact('class_id'));
    }

    public function InsertStudentFees(Request $request)
    {
        StudentFee::where('year_id', $request->year_id)->where('class_id', $request->class_id)
            ->where('date',$request->date)->where('fee_category_id',$request->fee_category_id)->delete();

        $count_fields = count($request->check_manage);
        if ($count_fields != null) {
            for ($i = 0; $i < $count_fields; $i++) {
                $new_student_payment = new StudentFee;
                $new_student_payment->student_id = $request->student_id[$i];
                $new_student_payment->year_id = $request->year_id;
                $new_student_payment->class_id = $request->class_id;
                $new_student_payment->fee_category_id = $request->fee_category_id;
                $new_student_payment->date = $request->date;
                $new_student_payment->amount = $request->account[$i];
                $new_student_payment->save();
            }
            $custome_msg = [
                'message' => 'Successfully updated Student Fees payment',
                'alert-type' => 'success',
            ];

            return redirect()->route('view.student.fee')->with($custome_msg);
        }else {
            $custome_msg = [
                'message' => 'Error No Students Selected',
                'alert-type' => 'error',
            ];

            return redirect()->route('view.student.fee')->with($custome_msg);
        }



    }
}
