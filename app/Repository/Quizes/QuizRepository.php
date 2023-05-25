<?php

namespace App\Repository\Quizes;


use App\Models\Grade;
use App\Models\Quize;
use App\Models\Subject;
use App\Models\Teacher;

class QuizRepository implements QuizInterface
{
    public function index()
    {
        $quizzes = Quize::get();
        return view('pages.Exams.index', compact('quizzes'));
    }

    public function create()
    {
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        return view('pages.Exams.create', $data);
    }

    public function store($request)
    {

        try {

            $quizzes = new Quize();
            $quizzes
                ->setTranslation('name','en',$request->Name_en)
                ->setTranslation('name','ar',$request->Name_ar);
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classrooms_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = $request->teacher_id;
            $quizzes->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('quiz.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $quizz = Quize::findorFail($id);
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        return view('pages.Exams.edit', $data, compact('quizz'));
    }

    public function update($request)
    {
        try {
            $quizz = Quize::findorFail($request->id);
            $quizz
                ->setTranslation('name','en',$request->Name_en)
                ->setTranslation('name','ar',$request->Name_ar);
            $quizz->subject_id = $request->subject_id;
            $quizz->grade_id = $request->Grade_id;
            $quizz->classrooms_id = $request->Classroom_id;
            $quizz->section_id = $request->section_id;
            $quizz->teacher_id = $request->teacher_id;
            $quizz->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('quiz.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Quize::destroy($request->id);
            toastr()->error(trans('messages.delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
