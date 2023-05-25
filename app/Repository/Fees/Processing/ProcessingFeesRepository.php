<?php

namespace App\Repository\Fees\Processing;

use App\Models\ProcessingFee;
use App\Models\StudentAcount;
use App\Models\Students;
use Illuminate\Support\Facades\DB;

class ProcessingFeesRepository implements ProcessingFeesInterface
{

    public function index()
    {
        $processingFees = ProcessingFee::all();
        return view('pages.Fees.processing_fees.index',compact('processingFees'));
    }


    public function store($request)
    {


        DB::beginTransaction();
        try {
            $processingFees               = new ProcessingFee();
            $processingFees->data         = now()->format('Y-m-d');
            $processingFees->student_id   = $request->student_id;
            $processingFees->amount       = $request->Debit;
            $processingFees->description  = $request->description;
            $processingFees->save();

            $studentAccount = new StudentAcount();
            $studentAccount->date = now()->format('Y-m-d');
            $studentAccount->type = 'processing_Fees';
            $studentAccount->processing_id  = $processingFees->id;
            $studentAccount->student_id = $request->student_id;
            $studentAccount->Debit = 0.00;
            $studentAccount->credit =$request->Debit;
            $studentAccount->description =$request->description;
            $studentAccount->save();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('processing_fees.index');

        }catch (\Exception $e){

            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function show($id)
    {
        $student = Students::findOrFail($id);

        return view('pages.Fees.processing_fees.add',compact('student'));
    }



    public function edit($id)
    {
        $processingFees = ProcessingFee::findOrFail($id);
        return view('pages.Fees.processing_fees.edit',compact('processingFees'));
    }

    public function update($request)
    {

        DB::beginTransaction();
        try {
            $processingFees               = ProcessingFee::findOrFail($request->id);
            $processingFees->data         = now()->format('Y-m-d');
            $processingFees->student_id   = $request->student_id;
            $processingFees->amount       = $request->Debit;
            $processingFees->description  = $request->description;
            $processingFees->save();

            $studentAccount = StudentAcount::where('processing_id',$request->id)->first();
            $studentAccount->date = now()->format('Y-m-d');
            $studentAccount->type = 'processing_Fees';
            $studentAccount->processing_id  = $processingFees->id;
            $studentAccount->student_id = $request->student_id;
            $studentAccount->Debit = 0.00;
            $studentAccount->credit =$request->Debit;
            $studentAccount->description =$request->description;
            $studentAccount->save();

            DB::commit();
            toastr()->success(trans('messages.update'));
            return redirect()->route('processing_fees.index');

        }catch (\Exception $e){

            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy($request)
    {

        ProcessingFee::findOrFail($request->id)->delete();
        toastr()->success(trans('messages.delete'));
        return redirect()->route('processing_fees.index');
    }


}
