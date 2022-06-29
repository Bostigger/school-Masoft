<?php

namespace App\Http\Controllers\Backend\Setups;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function DesignationPage()
    {
        $data['designations'] = Designation::all();
        return view('admin.setups.designation.view-designation',$data);
    }

    public function AddDesignationPage()
    {
        $data['designations'] = Designation::all();
        return view('admin.setups.designation.add-designation',$data);
    }

    public function AddNewDesignation(Request $request)
    {
        $request->validate([
            'name' => 'unique:designations'
        ]);

        $new_designation = new Designation;
        $new_designation->name = $request->name;
        $new_designation->save();

        $custome_msg = [
          'message'=>'Designation Succesfully added',
          'alert-type'=>'success'
        ];

        return redirect()->back()->with($custome_msg);
    }

    public function EditDesignation($id)
    {
        $data['selected_designation'] = Designation::find($id);
        $data['designations'] = Designation::all();
        return view('admin.setups.designation.edit-designation',$data);
    }

    public function UpdateDesignation(Request $request,$id)
    {
        $request->validate([
            'name' => 'unique:designations'
        ]);

        Designation::find($id)->update([
           'name'=>$request->name,
        ]);


        $custome_msg = [
            'message'=>'Designation Successfully Updated',
            'alert-type'=>'success'
        ];

        return redirect()->route('view.designations')->with($custome_msg);
    }

    public function DeleteDesignation($id)
    {
        Designation::find($id)->delete();


        $custome_msg = [
            'message'=>'Designation Successfully Delete',
            'alert-type'=>'warning'
        ];

        return redirect()->route('view.designations')->with($custome_msg);
    }
}
