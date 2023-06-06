<?php

namespace App\Repository\Library;

interface LibraryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request,$id);

    public function destroy($id);

    public function download($filename);

}
