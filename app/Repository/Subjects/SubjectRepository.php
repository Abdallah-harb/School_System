<?php

namespace App\Repository\Subjects;

class SubjectRepository implements SubjectInterface
{
    public function index()
    {
       return view('pages.subjects.index');
    }
}
