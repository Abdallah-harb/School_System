<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasTranslations;

    public $translatable = ['class_name'];

    protected $table = 'classrooms';
    protected $guarded = [];
    public $timestamps = true;



    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

}
