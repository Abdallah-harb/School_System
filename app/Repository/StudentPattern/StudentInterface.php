<?php
namespace App\Repository\StudentPattern;

interface StudentInterface
{
    //all students
    public function all_students();

        //create student
    public function createStudent();

    public function getclassroom($id);

    public function Get_Section($id);

    //store students
    public function storestudent($request);

    //show_All_student_info
    public function showmorinfo_student($id);

    //edit Student
    public function edit_student($id);

    //update student
    public function update_student($request);

    //delete student
    public function delete_student($request);

    //upload more image before show more info
    public function upload_more_image($request);

    //download image
    public function Download_attachment($studentsname, $filename);

    //delete attachments
    public function Delete_attachment($request);
}
