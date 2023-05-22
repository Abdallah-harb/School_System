<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use App\Repository\Fees\FeesInvoiceInterface;
use Illuminate\Http\Request;

class FeesInvoiceControoler extends Controller
{
    public $feesInvoice;
    public function __construct(FeesInvoiceInterface $feesInvoice){

        return $this->feesInvoice = $feesInvoice;
    }


    public function index()
    {
        return $this->feesInvoice->index();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return $this->feesInvoice->store($request);
    }


    public function show($id)
    {
        return $this->feesInvoice->add_fee_student($id);
    }



    public function update(Request $request)
    {
       return $this->feesInvoice->update($request);


    }


    public function destroy(Request $request)
    {
        return $this->feesInvoice->destroy($request);
    }
}
