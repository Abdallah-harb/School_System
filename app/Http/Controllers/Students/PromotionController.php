<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\StudentPattern\StudentPromotionInterface;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

            //Design Pattern
    public $promotion;
    public function __construct(StudentPromotionInterface $promotion){
        $this->promotion = $promotion;
    }
    public function index() {


        return $this->promotion->index();
    }

        //show promotion of students
    public function create(){

        return $this->promotion->create_manamgement();

    }


    public function store(Request $request)
    {


        return $this->promotion->store($request);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Request $request)
    {

        return $this->promotion->rollback_delete($request);
    }
}
