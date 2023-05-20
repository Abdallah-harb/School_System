<?php

namespace App\Http\Controllers\Grade;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Response;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $grades =Grade::all();
        return  view('pages.grade.grades',compact('grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
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

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
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

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
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
