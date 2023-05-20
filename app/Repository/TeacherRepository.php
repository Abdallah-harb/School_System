<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Spechalization;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements  TeacherRepositoryInterface{


    public function allteachers()
    {
      return Teacher::all();
    }

    public function Specialization()
    {
        return Spechalization::all();
    }

    public function gender()
    {
        return Gender::all();
    }

    public function storeteacher($request){
        try {

            $teacher = new Teacher();
            $teacher->email = $request->email;
            $teacher->password = Hash::make($request->password);
            $teacher
                ->setTranslation('name', 'en', $request->Name_en)
                ->setTranslation('name', 'ar', $request->Name_ar);
            $teacher->specialize_id = $request->specialize_id;
            $teacher->gender_id = $request->gender_id;
            $teacher->Joining_Date = $request->Joining_Date;
            $teacher->address = $request->address;
            $teacher->save();

            toastr()->success(trans('messages.success'),['timeOut' => 5000]);

            return redirect()->route('teachers.index');

        }catch (\Exception $ex) {

            toastr()->error(trans('messages.error'),['timeOut' => 8000]);
            return redirect()->route('teachers.index');

        }

    }

    //edit teachers
    public function editTeacher($id){

        $teacher = Teacher::findOrFail($id);
        if(!$teacher){
            toastr()->error(trans('messages.error'),['timeOut' => 8000]);
            return redirect()->route('teachers.index');
        }

        return $teacher;
    }

    //update teacher
    public function updateTeacher($request){

        try{

            $teacher = Teacher::findOrFail($request->id);
            $teacher -> email = $request->email;
            $teacher->password = Hash::make($request->password);
            $teacher
                ->setTranslation('name', 'en', $request->Name_en)
                ->setTranslation('name', 'ar', $request->Name_ar);
            $teacher->specialize_id = $request->specialize_id;
            $teacher->gender_id = $request->gender_id;
            $teacher->Joining_Date = $request->Joining_Date;
            $teacher->address = $request->address;
            $teacher->save();

            toastr()->success(trans('messages.Update'),['timeOut' => 5000]);

            return redirect()->route('teachers.index');


         }catch (\Exception $ex) {

            toastr()->error(trans('messages.error'),['timeOut' => 8000]);
            return redirect()->route('teachers.index');

        }

    }

    //delete teachers
    public function deleteTeacher($request){

        $teacher = Teacher::findOrFail($request->id)->delete();
        toastr()->warning(trans('messages.delete'));
        return redirect()->route('teachers.index');
    }




}
