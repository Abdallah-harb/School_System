<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiptStudent extends Model
{
    protected $table = 'receipt_students';
    protected $guarded=[];
    public $timestamps =true;

    public function student(){
        return $this->belongsTo(Students::class,'student_id');
    }
}
