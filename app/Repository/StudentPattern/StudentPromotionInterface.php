<?php

namespace App\Repository\StudentPattern;

interface StudentPromotionInterface
{

    public function index();

    //store promotion student
    public function store($request);

    //show promotion of student managements

    public function create_manamgement();


    //rollback promotion update and delete on promotion
    public function rollback_delete($request);
}
