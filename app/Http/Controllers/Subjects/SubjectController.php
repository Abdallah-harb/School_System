<?php

namespace App\Http\Controllers\Subjects;

use App\Http\Controllers\Controller;
use App\Repository\Subjects\SubjectInterface;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public $subject;
    public function __construct(SubjectInterface $subject){

        return $this->subject = $subject;

    }
    public function index()
    {
        return $this->subject->index();

    }


    public function create()
    {
        return $this->subject->create();
    }


    public function store(Request $request)
    {
        return $this->subject->store($request);
    }




    public function edit($id)
    {
        return $this->subject->edit($id);
    }


    public function update(Request $request, $id)
    {
        return $this->subject->update($request,$id);
    }


    public function destroy($id)
    {
        return $this->subject->destroy($id);
    }
}
