<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMarks extends Model
{
    use HasFactory;

    protected $fillable=[
      'marks'
    ];

    public function userClass()
    {
        return $this->belongsTo(User::class,'student_id','id');
    }

    public function AssignSubjectClass()
    {
        return $this->belongsTo(AssignSubject::class,'assign_subject_id','id');
    }

    public function ExamTypeClass()
    {
        return $this->belongsTo(ExamType::class,'exam_type_id','id');
    }

    public function YearClass()
    {
        return $this->belongsTo(StudentYear::class,'year_id','id');
    }

    public function StudentClass()
    {
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }


}
