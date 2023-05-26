<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Repository\Quizes\QuestionInterface;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public $question;
    public function __construct(QuestionInterface $question){
        return $this->question = $question;
    }

    public function index()
    {
        return $this->question->index();
    }

    public function create()
    {
        return $this->question->create();
    }

    public function store(Request $request)
    {
        return $this->question->store($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return $this->question->edit($id);
    }

    public function update(Request $request)
    {
        return $this->question->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->question->destroy($request);
    }


}
