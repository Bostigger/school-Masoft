<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignStudent extends Model
{
    use HasFactory;

    public function userClass()
    {
        return $this->belongsTo(User::class,'student_id','id');
    }

    public function studentYear()
    {
        return $this->belongsTo(StudentYear::Class,'year_id','id');
    }

    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }

    public function studentDiscount()
    {
        return $this->belongsTo(Discount::class,'student_id','student_id');
    }

    public function studentGroup()
    {
        return $this->belongsTo(StudentGroup::class,'group_id','id');
    }

    public function studentShift()
    {
        return $this->belongsTo(StudentShift::class,'shift_id','id');
    }

}
