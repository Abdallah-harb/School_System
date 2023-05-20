<?php
namespace App\Repository\StudentPattern\Graduation;
use App\Models\Grade;
use App\Models\Students;

class StudentGraduationRepository implements StudentGraduationInterface
{

    public function index()
    {
      $students = Students::onlyTrashed()->get();
      return view('pages.Students.Graduations.index',compact('students'));
    }

    public function create()
    {
        $Grades =Grade::all();

        return view('pages.Students.Graduations.create',compact('Grades'));
    }
    public function softDelete($request){

        if($request->page_id == 1){

            $student = Students::findOrFail($request->id)->delete();

            toastr()->success(trans('messages.graduate'),['timeOut' => 5000]);

            return redirect()->route('graduations.index');
        }

        $students = Students::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->classroom_id)->where('section_id',$request->section_id)->get();

        if(count( $students) < 1){
            toastr()->error(trans('messages.error'), ['timeOut' => 8000]);
            return redirect()->back();
        }
        foreach ($students as $student){

           $ids = explode(',',$student->id);
           Students::whereIn('id',$ids)->delete();
        }

        toastr()->success(trans('messages.delete'),['timeOut' => 5000]);

        return redirect()->route('graduations.index');


    }

    public function restoreData($request)
    {
        $student = Students::onlyTrashed()->where('id',$request->id)->restore();

        toastr()->success(trans('messages.Update'),['timeOut' => 5000]);

        return redirect()->route('graduations.index');
    }
    public function delete($request)
    {
        $student = Students::onlyTrashed()->where('id',$request->id)->forceDelete();

        toastr()->success(trans('messages.delete'),['timeOut' => 5000]);

        return redirect()->route('graduations.index');
    }


    //graduate only one student task
    public function graduate_one($request){

        return $request->id;
    }


}
