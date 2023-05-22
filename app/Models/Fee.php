<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{
    use HasTranslations;

    public $translatable = ['title'];

    protected $table = 'fees';
    protected $guarded =[];
    public $timestamps = true;

public function grade(){

    return $this->belongsTo(Grade::class,'grade_id','id');
}

public function classroom(){
    return $this->belongsTo(Classroom::class,'classroom_id','id');
}


}
