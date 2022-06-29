<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use HasFactory;


    public function LeavePurpose()
    {
        return $this->belongsTo(EmployeeLeavePurpose::class,'leave_purpose_id','id');
    }

    public function UserClass()
    {
        return $this->belongsTo(User::class,'employee_id','id');
    }
}
