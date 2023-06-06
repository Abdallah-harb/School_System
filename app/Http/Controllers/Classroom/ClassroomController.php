<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Response;
use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{


    public function index()
    {
        $classes = Classroom::all();
        $Grades = Grade::all();
        return view('pages.My_Classes.index', compact('classes', 'Grades'));
    }


  public function create()
  {

  }


  public function store(ClassroomRequest $request)
  {


      $Lists_Classes = $request->List_Classes;
      
      foreach ($Lists_Classes as $list_class){
          $myclasses = new Classroom();
          $myclasses
              ->setTranslation('class_name', 'en', $list_class['class_name_en'])
              ->setTranslation('class_name', 'ar', $list_class['class_name']);
          $myclasses->grade_id = $list_class['grade_id'];
          $myclasses->save();

      }
      toastr()->success(trans('messages.success'),['timeOut' => 5000]);

      return redirect()->route('classroom.index');
  }

  public function show($id)
  {

  }


  public function edit($id)
  {

  }


  public function update(Request $request)
  {


      try{
          $classroom = Classroom::find($request->id);
          if(!$classroom){
              toastr()->error(trans('messages.error'),['timeOut' => 8000]);
              return redirect()->route('classroom.index');
          }
          //update data on the categories_translation
          $classroom
              ->setTranslation('class_name', 'en', $request->class_name_en)
              ->setTranslation('class_name', 'ar',$request->class_name);
          $classroom->grade_id = $request->grade_id;
          $classroom -> save();


          toastr()->success(trans('messages.Update'),['timeOut' => 5000]);

          return redirect()->route('classroom.index');

      }catch (\Exception $ex){
            toastr()->error(trans('messages.error'),['timeOut' => 8000]);
          return redirect()->back()->withErrors(['error' =>$ex->getMessage()]);
      }

  }


  public function destroy(Request $request)
  {
      $classroom = Classroom::findOrFail($request->id)->delete();
      toastr()->warning(trans('messages.delete'));
      return redirect()->route('classroom.index');
  }
  public function deleteAll(Request $request){

      $allCheck = explode(',',$request->delete_all_id);

      Classroom::whereIn('id',$allCheck)->delete();

      toastr()->success(trans('messages.delete'),['timeOut' => 5000]);

      return redirect()->route('classroom.index');
  }

}

?>
