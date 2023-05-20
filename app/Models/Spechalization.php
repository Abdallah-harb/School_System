<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Spechalization extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $table = 'spechalizations';

    protected $fillable = ['name'];

    public $timestamps = true;
}
