<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $table = 'subjects';
    protected $guarded =[];
    public $timestamps = true;

    public function grade(){

        return $this->belongsTo(Grade::class,'grade_id');
    }

    public function classroom(){

        return $this->belongsTo(Classroom::class,'classroom_id');
    }
    public function teacher(){

        return $this->belongsTo(Teacher::class,'teacher_id');
    }
}
