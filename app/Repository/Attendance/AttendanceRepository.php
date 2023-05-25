<?php

namespace App\Repository\Attendance;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Students;

class AttendanceRepository implements AttendanceInterface
{

    public function index()
    {
        //هرجع المراحل والفصول بتاعتها ومن الفصل هجيب الفصل الدراسى من الموديل فى السيكشن
        $grades = Grade::with(['sections'])->get();
        return view('pages.Attendance.index',compact('grades'));
    }


    public function show($id)
    {
        $students = Students::with(['attendance'])->where('section_id',$id)->get();

        return view('pages.Attendance.show',compact('students'));
    }

    public function store($request)
    {

        try{
            foreach ($request->attendences as $studentid => $type){

                if($type == 'presence'){

                    $attendance_status = true;
                }else{
                    $attendance_status = false;
                }
            }

            $attendance = new Attendance();
            $attendance->student_id = $studentid;
            $attendance->grade_id = $request->grade_id;
            $attendance->classroom_id = $request->Classroom_id ;
            $attendance->section_id = $request->section_id;
            $attendance->teacher_id =1 ;
            $attendance->attendance_date =now()->format('Y-m-d') ;
            $attendance->attendance_status = $attendance_status;
            $attendance->save();
            toastr()->success(trans('messages.insert'));
            return redirect()->back();

        }catch (\Exception $ex){

            return redirect()->back()->withErrors(['error'=>$ex]);
        }

    }
}
