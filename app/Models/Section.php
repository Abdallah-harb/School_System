<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;

    public $translatable = ['section_name'];

    protected $table = 'sections';

    protected $guarded = [];

    public $timestamps = true;

    public function classrooms(){

        return $this->belongsTo(Classroom::class,'classroom_id','id');
    }

    //return all teachers that work on this class

    public function teachers(){

        return $this->belongsToMany(Teacher::class,'teacher_section','section_id','teacher_id');
    }

}
