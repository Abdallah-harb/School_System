<?php

namespace App\Repository\Fees\Receipt;

interface ReceiptStudentInterface
{
    public function index();

    public function show($id);

    public function store($request);

    public function edit($id);

    public function update($request);

    public function destroy($request);

}
