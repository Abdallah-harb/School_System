<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentStudent extends Model
{
    protected $table = 'payment_students';
    protected $guarded = [];
    public $timestamps = true;

    public function student(){

        return $this->belongsTo(Students::class,'student_id');
    }
}
