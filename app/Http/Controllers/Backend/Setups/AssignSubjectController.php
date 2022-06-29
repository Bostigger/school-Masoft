<?php

namespace App\Http\Controllers\Backend\Setups;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\StudentClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class AssignSubjectController extends Controller
{
    public function AssignSubjectPage()
    {
        $assign_subject_pages = AssignSubject::select('student_class_id')->groupBy('student_class_id')->get();
        return view('admin.setups.assign_subject.assign_subject-page',compact('assign_subject_pages'));

   }

    public function AddAssignSubjectPage()
    {
        $data['all_classes']=StudentClass::all();
        $data['all_subjects']=Subject::all();
        return view('admin.setups.assign_subject.add-assign-subject',$data);
    }

    public function AddSubjectAssignment(Request $request)
    {
        $count_fields = count($request->subject_id);
        if ($count_fields !=NULL){
            for ($i=0; $i < $count_fields; $i++){
                $new_assignment = new AssignSubject;
                $new_assignment -> student_class_id = $request -> student_class_id;
                $new_assignment -> subject_id = $request -> subject_id[$i];
                $new_assignment -> pass_mark = $request -> pass_mark[$i];
                $new_assignment -> subjective_mark = $request -> subjective_mark[$i];
                $new_assignment -> full_marks = $request -> full_marks[$i];
                $new_assignment -> save();
            }
            $custome_msg = [
              'message'=>'Assignment Successfully done',
              'alert-type'=>'success',
            ];

            return redirect()->route('view.assign.subject')->with($custome_msg);
        }
    }

    public function EditSubjectAssignmentPage($student_class_id)
    {
        $data['assignment_to_edit'] = AssignSubject::where('student_class_id',$student_class_id)->orderBy('student_class_id','asc')->get();
        $data['all_classes']=StudentClass::all();
        $data['all_subjects']=Subject::all();
        #dd($data['assignment_to_edit'])->toArray();
        return view('admin.setups.assign_subject.edit_assigned-subject',$data);
    }

    public function UpdateSubjectAssignment(Request $request,$student_class_id)
    {
        $count_fields = count($request->subject_id);
        if ($count_fields !=NULL){
            AssignSubject::where('student_class_id',$student_class_id)->delete();
            for ($i=0; $i < $count_fields; $i++){
                $new_assignment = new AssignSubject;
                $new_assignment -> student_class_id = $request -> student_class_id;
                $new_assignment -> subject_id = $request -> subject_id[$i];
                $new_assignment -> pass_mark = $request -> pass_mark[$i];
                $new_assignment -> subjective_mark = $request -> subjective_mark[$i];
                $new_assignment -> full_marks = $request -> full_marks[$i];
                $new_assignment -> save();
            }
            $custome_msg = [
                'message'=>'Assignment Successfully done',
                'alert-type'=>'success',
            ];

            return redirect()->route('view.assign.subject')->with($custome_msg);
        }
    }

    public function AssignmentDetailsPage($student_class_id)
    {
       $data['assignment_details'] = AssignSubject::where('student_class_id',$student_class_id)->get();
        $data['all_classes']=StudentClass::all();
        $data['all_subjects']=Subject::all();
        $data['details']=Subject::all();
        return view('admin.setups.assign_subject.assign_subject_details',$data);
    }
}
