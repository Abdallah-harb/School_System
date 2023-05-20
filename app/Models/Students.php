<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Students extends Model
{
    use HasTranslations , SoftDeletes;

    public $translatable = ['name'];

    protected $table = 'students';

    protected $guarded = [];

    public $timestamps = true;

    public function gender(){

        return $this->belongsTo(Gender::class,'gender_id','id');
    }

    public function grade(){

        return $this->belongsTo(Grade::class,'Grade_id','id');
    }
    public function Nationality(){

        return $this->belongsTo(Nationalitie::class,'nationalitie_id','id');
    }
    public function classroom(){

        return $this->belongsTo(Classroom::class,'Classroom_id','id');
    }
    public function section(){

        return $this->belongsTo(Section::class,'section_id','id');
    }

    public function myparent(){

        return $this->belongsTo(My_Parent::class,'parent_id','id');
    }

    //relation one-to-many polymorphic
    public function images(){

        return $this->morphMany(Image::class,'imageable');
    }


}
