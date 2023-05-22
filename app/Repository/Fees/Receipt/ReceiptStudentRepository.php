<?php

namespace App\Repository\Fees\Receipt;

use App\Models\FundAccount;
use App\Models\ReceiptStudent;
use App\Models\StudentAcount;
use App\Models\Students;
use Illuminate\Support\Facades\DB;

class ReceiptStudentRepository implements ReceiptStudentInterface
{
    public function index()
    {
        $studentreceipts = ReceiptStudent::all();
        return view('pages.Receipt.index',compact('studentreceipts'));
    }

    public function show($id)
    {
        $student = Students::findOrFail($id);

        return view('pages.Receipt.add',compact('student'));
    }

    public function store($request){

        DB::beginTransaction();
        try {
                $receiptStudent = new ReceiptStudent();
                $receiptStudent->data  = now()->format('Y-m-d');
                $receiptStudent->student_id  = $request->student_id;
                $receiptStudent->Debit  = $request->Debit;
                $receiptStudent->description  = $request->description;
                $receiptStudent->save();

                $fundAccount = new FundAccount();
                $fundAccount->data  = now()->format('Y-m-d');
                $fundAccount->receipt_id  = $receiptStudent->id;
                $fundAccount->Debit  =  $request->Debit;
                $fundAccount->Credit  =  0.00;
                $fundAccount->description  = $request->description;
                $fundAccount->save();

                $studentAccount = new StudentAcount();
                $studentAccount->date = now()->format('Y-m-d');
                $studentAccount->type = 'receipt';
                $studentAccount->receipt_id = $receiptStudent->id;
                $studentAccount->student_id = $request->student_id;
                $studentAccount->Debit = 0.00;
                $studentAccount->credit =$request->Debit;
                $studentAccount->description =$request->description;
                $studentAccount->save();

                DB::commit();
                toastr()->success(trans('messages.success'));
                return redirect()->route('receipt_student.index');

        }catch (\Exception $e){

                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $studentreceipt = ReceiptStudent::findOrFail($id);
        return view('pages.Receipt.edit',compact('studentreceipt'));
    }

    public function update($request)
    {

        DB::beginTransaction();
        try {
            $receiptStudent = ReceiptStudent::findOrFail($request->id);
            $receiptStudent->data  = now()->format('Y-m-d');
            $receiptStudent->student_id  = $request->student_id;
            $receiptStudent->Debit  = $request->Debit;
            $receiptStudent->description  = $request->description;
            $receiptStudent->save();

            $fundAccount = FundAccount::Where('receipt_id',$receiptStudent->id)->first();
            $fundAccount->data  = now()->format('Y-m-d');
            $fundAccount->receipt_id  = $receiptStudent->id;
            $fundAccount->Debit  =  $request->Debit;
            $fundAccount->Credit  =  0.00;
            $fundAccount->description  = $request->description;
            $fundAccount->save();

            $studentAccount = StudentAcount::where('receipt_id',$receiptStudent->id)->first();
            $studentAccount->date = now()->format('Y-m-d');
            $studentAccount->type = 'receipt';
            $studentAccount->receipt_id = $receiptStudent->id;
            $studentAccount->student_id = $request->student_id;
            $studentAccount->Debit = 0.00;
            $studentAccount->credit =$request->Debit;
            $studentAccount->description =$request->description;
            $studentAccount->save();

            DB::commit();
            toastr()->success(trans('messages.update'));
            return redirect()->route('receipt_student.index');

        }catch (\Exception $e){

            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy($request)
    {
        ReceiptStudent::findOrFail($request->id)->delete();
        toastr()->success(trans('messages.delete'));
        return redirect()->route('receipt_student.index');
    }


}
