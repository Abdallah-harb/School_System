<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Repository\Attendance\AttendanceInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public $attendance;
    public function __construct(AttendanceInterface $attendance)
    {
        return $this->attendance =$attendance;
    }


    public function index()
    {
        return $this->attendance->index();
    }


    public function store(Request $request)
    {
        return $this->attendance->store($request);
    }


    public function show($id)
    {
        return $this->attendance->show($id);
    }



    public function edit($id)
    {
        //
    }



    public function update(Request $request, $id)
    {
        //
    }



    public function destroy($id)
    {
        //
    }
}
