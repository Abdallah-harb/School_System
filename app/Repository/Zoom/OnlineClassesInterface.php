<?php

namespace App\Repository\Zoom;

interface OnlineClassesInterface
{
    public function index();

    public function create();

    public function store($request);

    public function delete($id);

    //offline classes

    public function indirectCreate();

    public function storeIndirect($request);
}
