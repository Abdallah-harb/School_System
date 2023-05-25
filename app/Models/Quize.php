<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quize extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $table = 'quizes';
    protected $guarded =[];
    public $timestamps = true;

    public function teacher(){

        return $this->belongsTo(Teacher::class,'teacher_id');
    }
    public function grade(){

        return $this->belongsTo(Grade::class,'grade_id');
    }
    public function classroom(){

        return $this->belongsTo(Classroom::class,'classrooms_id');
    }
    public function section(){

        return $this->belongsTo(Section::class,'section_id');
    }
}
