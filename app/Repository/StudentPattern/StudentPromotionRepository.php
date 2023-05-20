<?php

namespace App\Repository\StudentPattern;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Students;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository implements StudentPromotionInterface
{


    public function index()
    {
        $Grades = Grade::all();
        return view('pages.Students.promotion.index', compact('Grades'));
    }

    //show promotion management of students
    public function create_manamgement()
    {

        $promotions = Promotion::all();

        return view('pages.Students.promotion.managments', compact('promotions'));
    }

    public function store($request)
    {

        DB::beginTransaction();
        try {
            //get student info
            $students = Students::where('Grade_id', $request->Grade_id)
                ->where('Classroom_id', $request->Classroom_id)
                ->where('section_id', $request->section_id)->get();
            //if there are no students
            if ($students->count() < 1) {
                toastr()->error(trans('messages.error'), ['timeOut' => 8000]);
                return redirect()->back();
            }

            //update student
            foreach ($students as $student) {

                $ids = explode(',', $student->id); //[1,2,3,...]

                Students::whereIn('id', $ids)->update([
                    'Grade_id' => $request->Grade_id_new,
                    'Classroom_id' => $request->Classroom_id_new,
                    'section_id' => $request->section_id_new,
                ]);

                // insert in to promotions
                Promotion::updateOrCreate([

                    'student_id' => $student->id,
                    'from_grade' => $request->Grade_id,
                    'from_Classroom' => $request->Classroom_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->Grade_id_new,
                    'to_Classroom' => $request->Classroom_id_new,
                    'to_section' => $request->section_id_new,
                ]);
            }

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->back();

        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function rollback_delete($request)
    {
        DB::beginTransaction();
        try {
            if($request-> page_id == 1){
                $promotions = Promotion::all();

                if ($promotions->count() < 1) {
                    toastr()->error(trans('messages.error'), ['timeOut' => 8000]);
                    return redirect()->back();
                }


                //rollback for update
                foreach ($promotions as $promotion) {

                    $ids = explode(',', $promotion->id); //[1,2,3,...]

                    Students::whereIn('id', $ids)->update([
                        'Grade_id' => $promotion->from_grade,
                        'Classroom_id' => $promotion->from_Classroom,
                        'section_id' => $promotion->from_section,
                    ]);

                    Promotion::truncate();

                }
                DB::commit();
                toastr()->success(trans('messages.success'));
                return redirect()->back();
            }else{

                $promotion = Promotion::findOrFail($request->id);

                Students::where('id',$promotion->student_id)->update([
                    'Grade_id' => $promotion->from_grade,
                    'Classroom_id' => $promotion->from_Classroom,
                    'section_id' => $promotion->from_section,
                ]);
                Promotion::destroy($request->id);

                DB::commit();
                toastr()->success(trans('messages.delete'));
                return redirect()->back();

            }

        }catch (\Exception $e){

            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }





}
