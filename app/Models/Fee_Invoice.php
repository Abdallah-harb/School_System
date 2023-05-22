<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee_Invoice extends Model
{
    protected $table = 'fee__invoices';
    protected $guarded =[];
    public $timestamps = true;

    public function student(){

        return $this->belongsTo(Students::class,'student_id');
    }

    public function fee(){

        return $this->belongsTo(Fee::class,'fee_id');
    }


    public function grade(){

        return $this->belongsTo(Grade::class,'Grade_id');
    }

    public function classroom(){

        return $this->belongsTo(Classroom::class,'Classroom_id');
    }


}
