<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Repository\Quizes\QuizInterface;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    protected $quize;

    public function __construct(QuizInterface $quize)
    {
        $this->quize =$quize;
    }

    public function index()
    {
        return $this->quize->index();
    }

    public function create()
    {
        return $this->quize->create();
    }


    public function store(Request $request)
    {
        return $this->quize->store($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return $this->quize->edit($id);
    }

    public function update(Request $request)
    {
        return $this->quize->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->quize->destroy($request);
    }
}
