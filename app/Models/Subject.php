<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $table = 'subjects';
    protected $guarded =[];
    public $timestamps = true;
}
