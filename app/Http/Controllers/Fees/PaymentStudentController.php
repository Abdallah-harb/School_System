<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use App\Repository\Fees\Payment\PaymentStudentInterface;
use Illuminate\Http\Request;

class PaymentStudentController extends Controller
{
    public $paymentStudent;
    public function __construct(PaymentStudentInterface $paymentStudent){

        return $this->paymentStudent = $paymentStudent;
    }

    public function index()
    {
            return $this->paymentStudent->index();
    }


    public function store(Request $request)
    {
        return $this->paymentStudent->store($request);

    }



    public function show($id)
    {
        return $this->paymentStudent->show($id);
    }


    public function edit($id)
    {
        return $this->paymentStudent->edit($id);
    }


    public function update(Request $request)
    {

        return $this->paymentStudent->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->paymentStudent->destroy($request);
    }
}
