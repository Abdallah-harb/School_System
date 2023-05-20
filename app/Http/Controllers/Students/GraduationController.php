<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\StudentPattern\Graduation\StudentGraduationInterface;

class GraduationController extends Controller
{
    public $graduation;
    public function __construct(StudentGraduationInterface $graduation){
        return $this->graduation = $graduation;
    }

    public function index()
    {
        return $this->graduation->index();
    }

    public function create()
    {
        return $this->graduation->create();
    }


    public function store(Request $request)
    {
        return $this->graduation->softDelete($request);
    }

    //graduate only one student task
    public function graduate_one(Request $request){

        return $this->graduation->graduate_one($request);
    }



    public function update(Request $request)
    {
            return $this->graduation->restoreData($request);
    }


    public function destroy(Request $request)
    {
        return $this->graduation->delete($request);
    }
}
