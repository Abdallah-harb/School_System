<?php

namespace App\Repository\Fees;

interface FeesInvoiceInterface
{

    public function index();

    public function add_fee_student($id);

    public function store($request);

    public function update($request);

    public function destroy($request);

}
