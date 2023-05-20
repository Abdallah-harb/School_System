<?php
namespace App\Repository\StudentPattern\Graduation;
interface StudentGraduationInterface
{

    public function index();

    public function create();

    public function softDelete($request);

    public function restoreData($request);

    public function delete($request);

    //graduate only one student task
    public function graduate_one($request);

}
