<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Gender extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $table = 'genders';
    protected $fillable =['name'];



    public $timestamps = true;
}
