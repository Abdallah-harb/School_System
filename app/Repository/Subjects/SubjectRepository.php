<?php

namespace App\Repository\Subjects;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;

class SubjectRepository implements SubjectInterface
{
    public function index()
    {
        $subjects = Subject::all();
       return view('pages.subjects.index',compact('subjects'));
    }



    public function create()
    {
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.subjects.create',compact('grades','teachers'));
    }

    public function store($request)
    {
        try {
                $subject = new Subject();
                $subject
                    -> setTranslation('name','en',$request->name_en)
                    -> setTranslation('name','ar',$request->name_ar);
                $subject->grade_id = $request->grade_id;
                $subject->classroom_id = $request->Classroom_id;
                $subject->teacher_id = $request->teacher_id;
                $subject->save();
                toastr()->success(trans('messages.success'));
                return redirect()->route('subjects.index');

        }catch (\Exception $ex){

                return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }


    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.subjects.edit',compact('subject','grades','teachers'));
    }
    public function update($request, $id)
    {
        try {
            $subject = Subject::find($id);
            if(!$subject){
                toastr()->error(trans('messages.error'));
                return redirect()->route('subjects.index');
            }

            $subject
                -> setTranslation('name','en',$request->name_en)
                -> setTranslation('name','ar',$request->name_ar);
            $subject->grade_id = $request->grade_id;
            $subject->classroom_id = $request->Classroom_id;
            $subject->teacher_id = $request->teacher_id;
            $subject->save();

            toastr()->success(trans('messages.Update'));

            return redirect()->route('subjects.index');

        }catch (\Exception $ex){
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }

    }

    public function destroy($id)
    {
        try {

            $subject = Subject::find($id);
            if(!$subject){
                toastr()->error(trans('messages.error'));
                return redirect()->route('subjects.index');
            }
            $subject->delete();
            toastr()->success(trans('messages.delete'));
            return redirect()->route('subjects.index');

        }catch (\Exception $ex){

            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }

    }


}
