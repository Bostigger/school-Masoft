<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\OtherCost;
use Illuminate\Http\Request;

class OtherCostController extends Controller
{
    public function ViewOtherCostPage()
    {
        $data['all_other_costs'] = OtherCost::OrderBy('id', 'desc')->get();
        return view('admin.account.other_cost.view-other-cost-page', $data);
    }

    public function AddOtherCostPage()
    {
        return view('admin.account.other_cost.add-other-cost');
    }

    public function AddOtherCost(Request $request)
    {
        $image = $request->file('image');
        $unique_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $img_loc = 'account/images/';
        $image->move($img_loc,$unique_name);
        $save_img = $img_loc.$unique_name;

        $new_other_cost = new OtherCost;
        $new_other_cost -> date = date('y-m-d',strtotime($request->date));
        $new_other_cost -> amount = $request->amount;
        $new_other_cost -> image = $save_img;
        $new_other_cost -> description = $request->description;
        $new_other_cost -> save();

        $custom_msg = [
          'message'=>'Successfully inserted other cost',
          'alert-type'=>'success',
        ];
        return redirect()->back()->with($custom_msg);
    }

    public function EditOtherCostPage($id)
    {
            $data['selected_cost'] = OtherCost::find($id);
        return view('admin.account.other_cost.edit-cost-page',$data);
    }

    public function UpdateOtherCostPage(Request $request,$id)
    {
        if ( $request->file('image') !=null) {
            $image = $request->file('image');
            $unique_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img_loc = 'account/images/';
            $image->move($img_loc, $unique_name);
            $save_img = $img_loc . $unique_name;
            unlink($request->old_image);

            OtherCost::find($id)->update([
                'date'=>date('y-m-d', strtotime($request->date)),
                'amount'=>$request->amount,
                'description'=>$request->description,
                'image'=>$save_img,
            ]);

        }else{
            OtherCost::find($id)->update([
                'date'=>date('y-m-d', strtotime($request->date)),
                'amount'=>$request->amount,
                'description'=>$request->description,
            ]);
        }

        $custom_msg = [
            'message'=>'Successfully updated other cost',
            'alert-type'=>'success',
        ];
        return redirect()->back()->with($custom_msg);
    }

    public function DeleteOtherCostPage($id)
    {
        $selected_cost = OtherCost::find($id);
        unlink($selected_cost->image);
        $selected_cost->delete();
        $custom_msg = [
            'message'=>'Successfully deleted other cost',
            'alert-type'=>'warning',
        ];
        return redirect()->back()->with($custom_msg);
    }

}
