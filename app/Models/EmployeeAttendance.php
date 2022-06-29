<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    use HasFactory;

    public function userClass()
    {
        return $this->belongsTo(User::class,'employee_id','id');
    }


}
