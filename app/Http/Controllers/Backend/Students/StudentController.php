<?php

namespace App\Http\Controllers\Backend\Students;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\Discount;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDF;



class StudentController extends Controller
{
    public function ViewStudentList()
    {
        $data['student_years'] = StudentYear::all();
        $data['student_groups'] = StudentGroup::all();
        $data['student_class'] = StudentClass::all();
        $data['all_stud']= AssignStudent::all();

        $data['last_inserted_year_id'] = StudentYear::orderBy('id','desc')->first()->id;
        $data['last_inserted_class_id'] = StudentClass::orderBy('id','desc')->first()->id;
        $data['all_students'] = AssignStudent::where('year_id',$data['last_inserted_year_id'])
            ->where('class_id',$data['last_inserted_class_id'])->get();
        return view('admin.student.student_reg.view-students',$data);

    }

    public function AddStudentPage()
    {
        $data['student_years'] = StudentYear::all();
        $data['student_groups'] = StudentGroup::all();
        $data['student_class'] = StudentClass::all();
        $data['all_shifts'] = StudentShift::all();
        return view('admin.student.student_reg.add-student',$data);
    }

    public function AddNewStudent(Request $request)
    {
        DB::transaction(function()use ($request){
            $check_year = StudentYear::find($request->year_id)->name;
            $student = User::where('usertype','Student')->orderBy('id','DESC')->first();
            if($student == NULL){
                $firstReg = 0;
                $student_id = $firstReg + 1; #0+1 = 1
                if($student_id < 10){
                    $id_no = '000'.$student_id;
                }elseif ($student_id < 10){
                    $id_no = '00'.$student_id;
                }elseif ($student_id < 100){
                    $id_no = '0'.$student_id;
                }
            }else{
                $student =  User::where('usertype','Student')->orderBy('id','DESC')->first()->id;
                $student_id = $student + 1;
                if($student_id < 10){
                    $id_no = '000'.$student_id;
                }elseif ($student_id < 10){
                    $id_no = '00'.$student_id;
                }elseif ($student_id < 100){
                    $id_no = '0'.$student_id;
                }
            }
            $final_Id = $check_year.$id_no;
            $code = rand(0000,9999);
            $new_student = new User;
            $new_student->name = $request ->name;
            $new_student->fname = $request ->fname;
            $new_student->mname = $request ->mname;
            $new_student->id_no = $final_Id;
            $new_student->code = $code;
            $new_student->password = Hash::make( $code);
            $new_student->mobile = $request->mobile;
            $new_student->address = $request->address;
            $new_student->usertype = 'Student';
            $new_student->gender = $request->gender;
            $new_student->religion = $request->religion;
            $new_student->dob = date('Y-m-d',strtotime($request->dob));

            $selected_image = $request -> file('image');
            if($selected_image){
                $unique_image_name = hexdec(uniqid()).'.'.$selected_image->getClientOriginalExtension();
                $img_loc = 'student/images/';
                $save_img = $img_loc.$unique_image_name;
                $selected_image->move($img_loc,$unique_image_name);
                $new_student -> image = $save_img;
            }
            $new_student->save();

            $assign_new_student = new AssignStudent;
            $assign_new_student -> student_id = $new_student->id;
            $assign_new_student -> class_id = $request->class_id;
            $assign_new_student -> year_id = $request->year_id;
            $assign_new_student -> group_id = $request->group_id;
            $assign_new_student -> shift_id = $request->shift_id;
            $assign_new_student -> save();


            $new_discount = new Discount;
            $new_discount -> discount_amount = $request -> discount;
            $new_discount -> student_id = $assign_new_student->student_id;
            $new_discount -> fee_category_id = 3;
            $new_discount -> save();


        });
        $custom_nofication = [
            'message'=>'New Student Successfully regsitered',
            'alert-type'=>'success',
        ];

        return redirect()->back()->with($custom_nofication);

    }

    public function SearchStudents(Request $request)
    {
        $data['last_inserted_year_id'] = StudentYear::orderBy('id','desc')->first()->id;
        $data['last_inserted_class_id'] = StudentClass::orderBy('id','desc')->first()->id;
        $data['student_years'] = StudentYear::all();
        $data['student_groups'] = StudentGroup::all();
        $data['student_class'] = StudentClass::all();
        $data['all_stud']= AssignStudent::all();

        $data['searched_year']  = $request -> year_id;
        $data['searched_class']  = $request -> class_id;

        $data['searched_results'] = AssignStudent::where('year_id',$request->year_id)
            ->where('class_id',$request->class_id)->get();

        return view('admin.student.student_reg.view-students',$data);

    }

    public function EditSearch($student_id)
    {

        $data['student_years'] = StudentYear::all();
        $data['student_groups'] = StudentGroup::all();
        $data['student_class'] = StudentClass::all();
        $data['all_stud']= AssignStudent::all();
        $data['all_shifts'] = StudentShift::all();

       $data['selected_student'] = AssignStudent::where('student_id',$student_id)->first();

       $data['selected_user'] = User::find($student_id);
       return view('admin.student.student_reg.edit-student-page',$data);
    }

    public function UpdateUser(Request $request,$student_id)
    {
        DB::transaction(function ()use($request,$student_id){

            $update_user = User::where('id',$student_id)->first();
            $update_user -> name = $request ->name;
            $update_user -> fname = $request ->fname;
            $update_user -> mname = $request ->mname;
            $update_user -> mobile = $request ->mobile;
            $update_user -> gender = $request ->gender;
            $update_user -> address = $request ->address;
            $update_user -> religion = $request ->religion;
            $update_user -> dob = $request ->dob;
            $selected_image = $request -> file('image');
            if($selected_image){
                $unique_image_name = hexdec(uniqid()).'.'.$selected_image->getClientOriginalExtension();
                $img_loc = 'student/images/';
                $save_img = $img_loc.$unique_image_name;
                $selected_image->move($img_loc,$unique_image_name);
                $update_user -> image = $save_img;

                unlink($request->old_image);
            }
            $update_user -> save();


            $update_assigned_std = AssignStudent::where('id',$request->id)
                ->where('student_id',$student_id)->first();
            $update_assigned_std -> class_id = $request->class_id;
            $update_assigned_std -> year_id = $request->year_id;
            $update_assigned_std -> group_id = $request->group_id;
            $update_assigned_std -> shift_id = $request->shift_id;
            $update_assigned_std -> save();


            $update_discount = Discount::where('student_id',$student_id)->first();
            $update_discount ->discount_amount=$request -> discount;
            $update_discount ->save();
        });

        $custome_msg = [
          'message'=>'Successfully updated student Information',
          'alert-type'=>'Info',
        ];

        return redirect()->route('view.students')->with($custome_msg);

    }

    public function PromoteStudent($student_id)
    {
        $data['student_years'] = StudentYear::all();
        $data['student_groups'] = StudentGroup::all();
        $data['student_class'] = StudentClass::all();
        $data['all_shifts'] = StudentShift::all();
        $data['selected_student'] = AssignStudent::where('student_id',$student_id)->first();
        return view('admin.student.student_reg.promote-student',$data);
    }

    public function UpdateStudentPromotion(Request $request,$student_id)
    {
        AssignStudent::where('student_id',$student_id)->update([
         'class_id' => $request->class_id,
         'year_id' => $request->year_id,
         'group_id' => $request->group_id,
         'shift_id' => $request->shift_id,
        ]);
        $custome_msg = [
            'message'=>'Student Successfully Promoted',
            'alert-type'=>'Info',
        ];

        return redirect()->route('view.students')->with($custome_msg);
    }

    public function GenerateStudentDetails($student_id)
    {
        $data['selected_student'] = AssignStudent::where('student_id',$student_id)->first();
        $pdf = PDF::loadView('admin.student.student_reg.student_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }



}
