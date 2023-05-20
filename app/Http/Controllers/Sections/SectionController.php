<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $grades_sections = Grade::with(['sections'])->get();
      $list_grades = Grade::all();
      $teachers = Teacher::all();

      return view('pages.sections.sections',compact('grades_sections','list_grades','teachers'));

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

   // return $request;
      try {

              $sections = new Section();


              $sections
                  ->setTranslation('section_name', 'en', $request->section_name_En)
                  ->setTranslation('section_name', 'ar', $request->section_name);
              $sections->grade_id = $request->grade_id;
              $sections->classroom_id = $request->classroom_id;

              if(isset($request->status)){

                  $sections->status = 0;
              }else{
                  $sections->status = 1;
              }

              $sections->save();
              $sections->teachers()->attach($request->teacher_id);

              toastr()->success(trans('messages.success'),['timeOut' => 5000]);

              return redirect()->route('section.index');

       } catch (\Exception $ex) {

               toastr()->error(trans('messages.error'),['timeOut' => 8000]);
          return redirect()->back()->withErrors(['error' =>$ex->getMessage()]);
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
    try{
          $sections = Section::findOrFail($request->id);
          $sections
              ->setTranslation('section_name', 'en', $request->section_name_En)
              ->setTranslation('section_name', 'ar', $request->section_name);
          $sections->grade_id = $request->grade_id;
          $sections->classroom_id = $request->classroom_id;
          if(isset($request->status)) {
              $sections->Status = 1;
          } else {
              $sections->Status = 0;
          }
            //update Pivot table
          if(isset($request->teacher_id)){
              $sections->teachers()->sync($request->teacher_id);
          }else{
              $sections->teachers()->syncWithoutDetaching(array());
          }

          $sections-> save();
          toastr()->success(trans('messages.Update'),['timeOut' => 5000]);

         return redirect()->route('section.index');

        } catch (\Exception $ex) {

          toastr()->error(trans('messages.error'),['timeOut' => 8000]);
          return redirect()->back()->withErrors(['error' =>$ex->getMessage()]);
       }


  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
      $sections = Section::find($request->id)->delete();
      toastr()->warning(trans('messages.delete'));
      return redirect()->route('section.index');

  }

    public function getclasses($id)
    {
        $list_classes = Classroom::where("grade_id", $id)->pluck("class_name", "id");

        return $list_classes;
    }

}

?>
