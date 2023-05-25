<?php

namespace App\Repository\Attendance;

interface AttendanceInterface
{

    public function index();
    public function show($id);

    public function store($request);
}
