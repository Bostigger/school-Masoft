<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    use HasFactory;
    protected $fillable =[
        'present_salary',
        'previous_salary',
        'incremented_salary',
        'effected_date',
    ];

    public function alluserClass()
    {
        return $this->belongsTo(User::class,'employee_id','id');
    }
}
