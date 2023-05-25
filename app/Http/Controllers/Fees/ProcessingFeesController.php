<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use App\Repository\Fees\Processing\ProcessingFeesInterface;
use Illuminate\Http\Request;

class ProcessingFeesController extends Controller
{
    public $processingFees;
    public function __construct(ProcessingFeesInterface $processingFees)
    {
        return $this->processingFees = $processingFees;
    }

    public function index()
    {
        return $this->processingFees->index();
    }



    public function store(Request $request)
    {
        return $this->processingFees->store($request);
    }


    public function show($id)
    {
        return  $this->processingFees->show($id);
    }


    public function edit($id)
    {
        return $this->processingFees->edit($id);
    }


    public function update(Request $request)
    {
        return $this->processingFees->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->processingFees->destroy($request);
    }
}
