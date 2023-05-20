<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $table = 'teachers';

    protected $guarded = [];

    public $timestamps = true;




    public function gender(){

        return $this->belongsTo(Gender::class,'gender_id','id');
    }
    public function specialize(){

        return $this->belongsTo(Spechalization::class,'specialize_id','id');
    }

    // return all section that teachers work on

    public function sections(){

        return $this->belongsToMany(Section::class,'teacher_section','teacher_id','section_id','id','id');
    }


}
