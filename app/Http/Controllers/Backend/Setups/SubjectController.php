<?php

namespace App\Http\Controllers\Backend\Setups;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function ViewSubjects()
    {
        $all_subjects = Subject::all();
        return view('admin.setups.student_subjects.view-subjects',compact('all_subjects'));

    }

    public function AddSubjectPage()
    {
        return view('admin.setups.student_subjects.add-subject-page');
    }

    public function AddStudentSubject(Request $request)
    {
       $request -> validate([
          'subject_name'=>'unique:subjects'
       ]);
        $count_fields = count($request ->subject_name);
        if ($count_fields !=NULL ){
            for($i=0; $i < $count_fields; $i++){
                    $new_subject = new Subject;
                    $new_subject -> subject_name = $request -> subject_name[$i];
                    $new_subject->save();
                }

            $custome_msg = [
              'message'=>'Subject Successfully inserted',
              'alert-type'=>'success',
            ];
            return redirect()->route('view.subject')->with($custome_msg);
        }
    }

    public function EditSubjectPage($id)
    {
        $data['selected_subject'] = Subject::find($id);
        $data['all_subjects'] = Subject::all();
        return view('admin.setups.student_subjects.edit-subject-page',$data);
    }

    public function UpdateSubject(Request $request, $id)
    {
        Subject::find($id)->update([
           'subject_name'=>$request -> subject_name,
        ]);
        $custome_msg = [
            'message'=>'Subject Successfully Updated',
            'alert-type'=>'success',
        ];
        return redirect()->route('view.subject')->with($custome_msg);
    }

    public function DeleteSubject($id)
    {
        Subject::find($id)->delete();
        $custome_msg = [
            'message'=>'Subject Successfully deleted',
            'alert-type'=>'warning',
        ];
        return redirect()->route('view.subject')->with($custome_msg);
    }

}
