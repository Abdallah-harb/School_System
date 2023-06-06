<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class OnlineClasse extends Model
{


    protected $table = 'online_classes';
    protected $guarded = [];
    public $timestamps = true;


    public function grade(){

        return $this->belongsTo(Grade::class,'Grade_id','id');
    }
    public function classroom(){

        return $this->belongsTo(Classroom::class,'Classroom_id','id');
    }
    public function section(){

        return $this->belongsTo(Section::class,'section_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
