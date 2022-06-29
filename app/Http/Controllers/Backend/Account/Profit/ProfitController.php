<?php

namespace App\Http\Controllers\Backend\Account\Profit;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAccountSalary;
use App\Models\OtherCost;
use App\Models\StudentFee;
use Illuminate\Http\Request;
use PDF;

class ProfitController extends Controller
{
    public function ViewProfitPage()
    {
        return view('admin.account.profit.view-profit-page');
    }

    public function FetchMonthlyDateRangeData(Request $request)
    {
        $start_date = $request -> start_date;
        $end_date = $request -> end_date;

        $student_fees =StudentFee::whereBetween('date',[$start_date,$end_date])->sum('amount');
        $employee_payment_fees =EmployeeAccountSalary::whereBetween('date',[$start_date,$end_date])->sum('amount');
        $other_costs =OtherCost::whereBetween('date',[$start_date,$end_date])->sum('amount');
        $total_amount_spent = $employee_payment_fees + $other_costs;
        $monthly_profit = $student_fees - $total_amount_spent;

        return view('admin.account.profit.profit-details-page',compact('student_fees','employee_payment_fees','other_costs','total_amount_spent','monthly_profit','start_date','end_date'));

    }

    public function ViewProfitDetails($start_date,$end_date)
    {
        $student_fees =StudentFee::whereBetween('date',[$start_date,$end_date])->sum('amount');
        $employee_payment_fees =EmployeeAccountSalary::whereBetween('date',[$start_date,$end_date])->sum('amount');
        $other_costs =OtherCost::whereBetween('date',[$start_date,$end_date])->sum('amount');
        $total_amount_spent = $employee_payment_fees + $other_costs;
        $monthly_profit = $student_fees - $total_amount_spent;


        $pdf = PDF::loadView('admin.account.profit.export-profit',compact('student_fees','employee_payment_fees','other_costs','total_amount_spent','monthly_profit','start_date','end_date' ));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('profit.pdf');
    }
}
