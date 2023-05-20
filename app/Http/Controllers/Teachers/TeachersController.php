<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Response;
use App\Http\Requests\TeacherRequest;
use App\Repository\TeacherRepository;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
                        ####################################################
                        ####################################################
                        ##### We use Design pattern [app->Repository ] #####
                        ####################################################
                        ####################################################
                        ####################################################
    public $teachers;

    public function __construct(TeacherRepositoryInterface  $teachers) // call class of design pattern
    {
        $this->teacher = $teachers;
    }

    /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
        $teachers =  $this->teacher->allteachers();
        return view('pages.teachers.index',compact('teachers'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
        $specializations = $this->teacher->Specialization();
        $genders = $this->teacher->gender();
        return view('pages.teachers.create',compact('specializations','genders'));
  }

  public function store(TeacherRequest $request)
  {

      return $this->teacher->storeteacher($request);

  }

  public function edit($id)
  {
          $teacher = $this->teacher->editTeacher($id);
          $specializations = $this->teacher->Specialization();
          $genders = $this->teacher->gender();
          return view('pages.teachers.edit',compact('teacher','specializations','genders'));
  }

  public function update(TeacherRequest $request)
  {


        return $this->teacher->updateTeacher($request);
  }


  public function destroy(Request $request)
  {
        return $this->teacher->deleteTeacher($request);

  }



}

?>
