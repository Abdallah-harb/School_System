<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';

    protected $guarded = [];

    public $timestamps = true;


    public function student()
    {
        return $this->belongsTo(Students::class,'student_id');
    }
    public function f_garde()
    {
        return $this->belongsTo(Grade::class,'from_grade');
    }
    public function f_classroom()
    {
        return $this->belongsTo(Classroom::class,'from_Classroom');
    }
    public function f_section()
    {
        return $this->belongsTo(Section::class,'from_section');
    }


    public function t_garde()
    {
        return $this->belongsTo(Grade::class,'to_grade');
    }
    public function t_classroom()
    {
        return $this->belongsTo(Classroom::class,'to_Classroom');
    }
    public function t_section()
    {
        return $this->belongsTo(Section::class,'to_section');
    }


}
