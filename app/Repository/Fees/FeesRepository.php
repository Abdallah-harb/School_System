<?php

namespace App\Repository\Fees;

use App\Models\Fee;
use App\Models\Grade;

class FeesRepository implements FeesInterface
{


    public function index()
    {
        $fees = Fee::all();
        return view('pages.Fees.index',compact('fees'));
    }

    public function create()
    {
        $fees = Fee::all();
        $Grades = Grade::all();
        return view('pages.Fees.create',compact('fees','Grades'));
    }

    public function store($request)
    {

        try {

            $fees = new Fee();
            $fees
                ->setTranslation('title','en',$request->title_en)
                ->setTranslation('title','ar',$request->title_ar);
            $fees->fee_type       = $request->fee_type;
            $fees->amount         = $request->amount;
            $fees->grade_id       = $request->Grade_id;
            $fees->classroom_id   = $request->Classroom_id;
            $fees->year           = $request->year;
            $fees->notes          = $request->notes;

            $fees->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('fees.index');

        }catch (\Exception $e){

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function edit($id)
    {
        $fee = Fee::findOrFail($id);
        $Grades = Grade::all();
        return view('pages.Fees.edit',compact('fee','Grades'));
    }

    public function update($request)
    {
        try {

            $fee = Fee::findOrFail($request->id);
            $fee
                ->setTranslation('title','en',$request->title_en)
                ->setTranslation('title','ar',$request->title_ar);
            $fee->fee_type       = $request->fee_type;
            $fee->amount         = $request->amount;
            $fee->grade_id       = $request->Grade_id;
            $fee->classroom_id   = $request->Classroom_id;
            $fee->year           = $request->year;
            $fee->notes          = $request->notes;

            $fee->save();

            toastr()->success(trans('messages.Update'));

            return redirect()->route('fees.index');

        }catch (\Exception $e){

        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }


    public function destroy($request)
    {

        $fee = Fee::findOrFail($request->id)->delete();
        toastr()->success(trans('messages.delete'));

        return redirect()->route('fees.index');


    }


}
