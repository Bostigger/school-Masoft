<?php

namespace App\Http\Controllers\Backend\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\Discount;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDF;

class RollGeneratorController extends Controller
{
    public function RollGeneratePage()
    {
        $data['student_years'] = StudentYear::all();
        $data['student_class'] = StudentClass::all();
        return view('admin.student.roll_generate.roll-generate-view',$data);
    }

    public function GetAllStudents(Request $request)
    {
        $all_students = AssignStudent::with(['userClass'])->where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
        #dd($data['all_students'])->toArray();
        return response()->json($all_students);
    }

    public function InsertRoll(Request $request)
    {
        $year_id = $request -> year_id;
        $class_id = $request -> class_id;
      if($request->roll==NULL){
          $custome_msg = [
              "message"=>"sorry no student available",
              "alert-type"=>"error"
          ];
          return redirect()->back()->with($custome_msg);

      }else{
          for ($i=0; $i<(count($request ->roll)); $i++){
              AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->
              where('student_id',$request->student_id[$i])->update([
                  'roll' => $request -> roll[$i],
              ]);
          }
          $custome_msg = array(
              "message"=>"Roll Generated Successfully",
              "alert-type"=>"Success"
          );
          return redirect()->route('roll.generate.view')->with($custome_msg);
      }

    }
}
