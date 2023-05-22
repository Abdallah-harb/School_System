<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use App\Models\FundAccount;
use App\Models\ReceiptStudent;
use App\Models\StudentAcount;
use App\Repository\Fees\Receipt\ReceiptStudentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptStudentController extends Controller
{
    public $receiptStudent;
    public function __construct(ReceiptStudentInterface $receiptStudent){

        return $this->receiptStudent = $receiptStudent;
    }


    public function index()
    {
        return $this->receiptStudent->index();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return $this->receiptStudent->store($request);
    }


    public function show($id)
    {
        return $this->receiptStudent->show($id);
    }


    public function edit($id)
    {
        return $this->receiptStudent->edit($id);
    }


    public function update(Request $request)
    {
        return $this->receiptStudent->update($request);
    }

    public function destroy(Request  $request)
    {
        return $this->receiptStudent->destroy($request);
    }
}
