<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
   protected $table = 'questions';
   protected $guarded = [];
   public $timestamps = true;


   public function quizze()
   {
       return $this->belongsTo(Quize::class,'quizze_id');
   }
}
