<?php

namespace App\Http\Controllers\Grade;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Response;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{


  public function index()
  {
      $grades =Grade::all();
        return  view('pages.grade.grades',compact('grades'));
  }

  public function create()
  {

  }

  public function store(Request $request)
  {


       try {
           if(Grade::where('name->ar',$request->name)->orWhere('name->en',$request->name_en)->exists()){

               toastr()->error(trans('messages.again'),['timeOut' => 8000]);
               return redirect()->route('grade.index');
           }

          $grade = new Grade ();
          $grade
              ->setTranslation('name', 'en', $request->name_en)
              ->setTranslation('name', 'ar', $request->name);
          $grade->notes = $request->notes;
          $grade->save();

          toastr()->success(trans('messages.success'),['timeOut' => 5000]);

          return redirect()->route('grade.index');
       } catch (\Exception $ex) {
           toastr()->error(trans('messages.error'),['timeOut' => 8000]);
           return redirect()->route('grade.index');

       }
  }


  public function show($id)
  {

  }

  public function edit($id)
  {

  }


  public function update(Request $request)
  {

      $grade = Grade::findOrFail($request->id);

      $grade->setTranslation('name', 'en', $request->name_en)
          ->setTranslation('name', 'ar', $request->name)
          ->save();

      $grade->notes = $request->notes;
      $grade->save();

       toastr()->success(trans('messages.Update'),['timeOut' => 5000]);

      return redirect()->route('grade.index');
  }



  public function destroy(Request $request)
  {

      $grade = Grade::find(($request->id));
      $classroom = $grade->classrooms;
      if(count($classroom) > 0 ){
          toastr()->warning(trans('messages.exisit_classrooms'));
          return redirect()->route('grade.index');
      }else{

          $grade = Grade::findOrFail($request->id)->delete();
          toastr()->warning(trans('messages.delete'));
          return redirect()->route('grade.index');

      }
      /*
        $grade = Grade::findOrFail($request->id)->delete();
      toastr()->warning(trans('messages.delete'));
      return redirect()->route('grade.index');
      */

  }

}

?>
