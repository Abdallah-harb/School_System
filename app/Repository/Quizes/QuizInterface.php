<?php

namespace App\Repository\Quizes;

interface QuizInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request);

    public function destroy($request);

}
