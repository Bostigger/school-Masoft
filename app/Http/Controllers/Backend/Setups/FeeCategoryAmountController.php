<?php

namespace App\Http\Controllers\Backend\Setups;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class FeeCategoryAmountController extends Controller
{
    public function FeeCategoryAmountPage()
    {
       $fee_cat_amount = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
       return view('admin.setups.fee_amount.view-fee-category-amount',compact('fee_cat_amount'));
    }

    public function AddFeeCategoryAmountPage()
    {
        $fee_cat_amount = FeeCategoryAmount::all();
        $student_classes = StudentClass::all();
        $fee_categories = FeeCategory::all();
        return view('admin.setups.fee_amount.add-fee-amount',compact('student_classes','fee_categories','fee_cat_amount'));

    }

    public function AddFeeCategoryAmount(Request $request)
    {
//        $request ->validate([
//           'student_class_id'=>'required|unique:fee_amount'
//        ]);
        $count_fields = count($request->student_class_id);
        if ($count_fields !=NULL ){
                for($i=0; $i < $count_fields; $i++){
                    $new_fee_amount = new FeeCategoryAmount;
                    $new_fee_amount -> fee_category_id = $request -> fee_category_id;
                    $new_fee_amount -> student_class_id = $request -> student_class_id[$i];
                    $new_fee_amount -> fee_amount = $request -> fee_amount[$i];
                    $new_fee_amount -> save();
                }
        }
        $custome_msg = [
            'message'=>'Fee Category successfully inserted',
            'alert-type'=>'success',
        ];
        return redirect()->route('view.fee.amount')->with($custome_msg);

    }

    public function EditFeeCategoryAmountPage($fee_category_id)
    {
        $data['selected_category'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBY('student_class_id','asc')->get();
        $data['student_classes'] = StudentClass::all();
        $data['fee_categories']= FeeCategory::all();

        return view('admin.setups.fee_amount.edit-fee-amount',$data);
    }

    public function UpdateFeeCategoryAmount(Request $request,$fee_category_id)
    {
        if ($request->fee_amount == NULL){

            $custome_msg = [
                'message'=>'Sorry! You cant update empty fields',
                'alert-type'=>'error',
            ];

            return redirect()->back()->with($custome_msg);

        }else{
            $count_fields = count($request -> fee_amount);
            FeeCategoryAmount::where('fee_category_id',$fee_category_id)->delete();
            for ($i=0; $i < $count_fields; $i++){
                $new_fee_amount_category = new FeeCategoryAmount;
                $new_fee_amount_category -> fee_amount = $request->fee_amount[$i];
                $new_fee_amount_category -> student_class_id = $request->student_class_id[$i];
                $new_fee_amount_category -> fee_category_id = $request->fee_category_id;
                $new_fee_amount_category -> save();
            }

        }

        $custome_msg = array(
            'message'=>'Fee Category Successfully Updated',
            'alert-type'=>'Success',
        );
        return redirect()->route('view.fee.amount')->with($custome_msg);
    }

    public function ViewFeeCategoryDetails($fee_category_id)
    {
       $selected_category =  FeeCategoryAmount::where('fee_category_id',$fee_category_id)->get();
       return view('admin.setups.fee_amount.fee-category-details',compact('selected_category'));
    }
}
