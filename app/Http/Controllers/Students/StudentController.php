<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\Request;
use App\Repository\StudentPattern\StudentInterface;

class StudentController extends Controller
{
    public $student;
    public function __construct(StudentInterface $student){
        return $this->student =$student;
    }

    public function index()
    {
        return $this->student->all_students();
    }


    public function create()
    {
        return $this->student->createStudent();
    }


    public function store(Request $request)
    {
        return $this->student->storestudent($request);
    }

    public function show($id){

        return $this->student->showmorinfo_student($id);
    }

    public function edit($id)
    {
        return $this->student->edit_student($id);
    }


    public function update(StudentRequest $request)
    {
        return $this->student->update_student($request);
    }


    public function destroy(Request $request)
    {
        return $this->student->delete_student($request);
    }


    public function Get_classrooms($id){
        return $this->student->getclassroom($id);
  }
    public function Get_Sections($id){

        return $this->student->Get_Section($id);
    }

    //upload image when show more info for student
    public function upload_image(Request $request){

        return $this->student->upload_more_image($request);
    }
    //download image attachments
    public function Download_attachment($student_name,$filename){

        return $this->student->Download_attachment($student_name,$filename);
    }

    //delete attachments
    public function Delete_attachment(Request $request){

        return $this->student->Delete_attachment($request);
    }


}
