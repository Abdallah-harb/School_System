<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $table = 'libraries';
    protected $guarded = [];
    public $timestamps = true;

    public function grade(){
        return $this->belongsTo(Grade::class,'grade_id');
    }

    public function classroom(){

        return $this->belongsTo(Classroom::class,'classroom_id');
    }
}
