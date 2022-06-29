<?php

namespace App\Http\Controllers\Backend\Setups;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    public function ViewFeeCategory()
    {
        $fee_category = FeeCategory::all();
        return view('admin.setups.fee_category.view-fee-category',compact('fee_category'));
    }

    public function AddFeeCategoryPage()
    {
        $fee_category = FeeCategory::all();
        return view('admin.setups.fee_category.add-fee-category',compact('fee_category'));
    }

    public function AddFeeCategory(Request $request)
    {
        $request -> validate([
           'name'=>'required|unique:fee_categories',
        ]);
        $new_fee_category = new FeeCategory;
        $new_fee_category -> name = $request -> name;
        $new_fee_category -> save();

        $custome_msg = [
          'message'=>'Fee Category Successfully Inserted',
          'alert-type'=>'info'
        ];

        return redirect()->back()->with($custome_msg);
    }

    public function EditFeeCategory($id)
    {
        $fee_category = FeeCategory::all();
        $selected_fee_category = FeeCategory::find($id);
        return view('admin.setups.fee_category.edit-fee-category',compact('selected_fee_category','fee_category'));
    }

    public function UpdateFeeCategory(Request $request,$id)
    {
        $request -> validate([
           'name'=>'required|unique:fee_categories'
        ]);
        FeeCategory::find($id)->update([
           'name'=>$request->name,
        ]);
        $custome_msg = [
            'message'=>'Fee Category Successfully Updated',
            'alert-type'=>'success'
        ];

        return redirect()->route('view.fee.category')->with($custome_msg);
    }

    public function DeleteFeeCategory($id)
    {
        FeeCategory::find($id)->delete();
        $custome_msg = [
            'message'=>'Fee Category Successfully deleted',
            'alert-type'=>'warning'
        ];

        return redirect()->back()->with($custome_msg);
    }
}
