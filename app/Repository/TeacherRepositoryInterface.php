<?php
namespace App\Repository;

interface TeacherRepositoryInterface {

    //get all teachet
    public function allteachers();

    //get Specialization

    public function Specialization();

    // get all gender
    public function gender();

    //store new teacher
    public function storeteacher($request);

    //edit teachers
    public function editTeacher($id);

    //update teachers
    public function updateTeacher($request);

    //delete teacher
    public function deleteTeacher($request);
}
