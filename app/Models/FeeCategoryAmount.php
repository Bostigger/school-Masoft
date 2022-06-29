<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeCategoryAmount extends Model
{
    use HasFactory;
    protected $fillable =[
      'fee_category_id',
      'student_class_id',
      'fee_amount',
    ];

    public function FeeCategory()
    {
        return $this -> belongsTo(FeeCategory::class,'fee_category_id','id');
    }

    public function ClassName()
    {
        return $this -> belongsTo(StudentClass::class,'student_class_id','id');
    }
}
