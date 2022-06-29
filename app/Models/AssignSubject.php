<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
//    use HasFactory;
//

    public function SubjectClass()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }

    public function StudentClass()
    {
        return $this->belongsTo(StudentClass::class,'student_class_id','id');
    }

}
