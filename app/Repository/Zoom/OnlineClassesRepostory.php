<?php

namespace App\Repository\Zoom;

use App\Models\Grade;
use App\Models\OnlineClasse;
use Illuminate\Support\Facades\DB;
use MacsiDigital\Zoom\Facades\Zoom;

class OnlineClassesRepostory implements OnlineClassesInterface
{

    public function index()
    {
        $onlineClasses = OnlineClasse::all();
        return view('pages.OnlineClasses.index',compact('onlineClasses'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.OnlineClasses.create',compact('grades'));
    }

    public function store($request)
    {
        try {

            $user = Zoom::user()->first();
            $mettingData = [

                'topic'      => $request->topic,
                'duration'   => $request->duration,
                'start_time' => $request->start_time,
                'timezone'    => 'Africa/Cairo',
            ];

            $meeting = Zoom::meeting()->make($mettingData);

            //setting of meeting such as voice video password
            $meeting->settings()->make([
                'join_before_host' => true,
                'approval_type' => 1,
                'registration_type' => 2,
                'enforce_login' => false,
                'waiting_room' => false,
            ]);
            // meeting create
            $user->meetings()->save($meeting);

            //save data on database
            OnlineClasse::create([

                'grade_id' => $request->grade_id,
                'classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'user_id' => auth()->user()->id,
                'meeting_id' => $meeting->id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $meeting->duration,
                'password' => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
            ]);
            toastr()->success(trans('messages.success'),['timeOut' => 5000]);

            return redirect()->route('online_classes.index');

        }catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);

        }

    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            //delete from Zoom

            $meeting = Zoom::meeting()->find($id);

            $meeting->delete();
            //delete from database
            OnlineClasse::where('meeting_id',$id)->delete();

            DB::commit();
            toastr()->success(trans('messages.delete'),['timeOut' => 5000]);
            return redirect()->route('online_classes.index');

        }catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);

        }


    }
        //offline classes
    public function indirectCreate()
    {
        $grades = Grade::all();
        return view('pages.OnlineClasses.indirect',compact('grades'));
    }
        //offline classes
    public function storeIndirect($request)
    {

      //  try {

            OnlineClasse::create([

                'grade_id' => $request->grade_id,
                'classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'user_id' => auth()->user()->id,
                'meeting_id' => $request->meeting_id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);
            toastr()->success(trans('messages.success'),['timeOut' => 5000]);

            return redirect()->route('online_classes.index');

        //}catch (\Exception $ex) {
          //  return redirect()->back()->withErrors(['error' => $ex->getMessage()]);

       // }

    }
}
