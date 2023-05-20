<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $table = 'grades';
    protected $guarded =[];
    public $timestamps = true;

    public function classrooms(){

        return $this->hasMany(Classroom::class,'grade_id','id');
    }

    public function sections(){

        return $this->hasMany(Section::class,'grade_id');
    }

}
