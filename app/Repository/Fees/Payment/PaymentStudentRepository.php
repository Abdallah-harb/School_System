<?php

namespace App\Repository\Fees\Payment;

use App\Models\FundAccount;
use App\Models\PaymentStudent;
use App\Models\StudentAcount;
use App\Models\Students;
use Illuminate\Support\Facades\DB;

class PaymentStudentRepository implements PaymentStudentInterface
{

    public function index()
    {
      $paymentStudents = PaymentStudent::all();
      return view('pages.fees.Payment.index',compact('paymentStudents'));
    }

    public function show($id)
    {
        $student = Students::findOrfail($id);
        return view('pages.fees.Payment.add',compact('student'));
    }

    public function store($request)
    {

        DB::beginTransaction();
        try {

            $paymentstudent               = new PaymentStudent();
            $paymentstudent->date         = now()->format('Y-m-d');
            $paymentstudent->student_id   = $request->student_id;
            $paymentstudent->amount       = $request->Debit;
            $paymentstudent->description  = $request->description;
            $paymentstudent->save();

            $studentAccount = new StudentAcount();
            $studentAccount->date = now()->format('Y-m-d');
            $studentAccount->type = 'paymentstudent';
            $studentAccount->payment_id  = $paymentstudent->id;
            $studentAccount->student_id = $request->student_id;
            $studentAccount->Debit = $request->Debit;
            $studentAccount->credit = 0.00;
            $studentAccount->description =$request->description;
            $studentAccount->save();

            $fundAccount = new FundAccount();
            $fundAccount->data  = now()->format('Y-m-d');
            $fundAccount->payment_id  = $paymentstudent->id;
            $fundAccount->Debit  =  0.00;
            $fundAccount->Credit  = $request->Debit;
            $fundAccount->description  = $request->description;
            $fundAccount->save();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('PaymentStudent.index');

        }catch (\Exception $e){

            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }



    }

    public function edit($id)
    {
        $paymentStudents = PaymentStudent::findOrFail($id);
        return view('pages.fees.Payment.edit',compact('paymentStudents'));
    }

    public function update($request)
    {


        DB::beginTransaction();
        try {

            $paymentstudent               = PaymentStudent::findOrFail($request->id);
            $paymentstudent->date         = now()->format('Y-m-d');
            $paymentstudent->student_id   = $request->student_id;
            $paymentstudent->amount       = $request->Debit;
            $paymentstudent->description  = $request->description;
            $paymentstudent->save();

            $studentAccount = StudentAcount::where('payment_id',$paymentstudent->id)->first();
            $studentAccount->date = now()->format('Y-m-d');
            $studentAccount->type = 'paymentstudent';
            $studentAccount->payment_id  = $paymentstudent->id;
            $studentAccount->student_id = $request->student_id;
            $studentAccount->Debit = $request->Debit;
            $studentAccount->credit = 0.00;
            $studentAccount->description =$request->description;
            $studentAccount->save();

            $fundAccount = FundAccount::where('payment_id',$paymentstudent->id)->first();
            $fundAccount->data  = now()->format('Y-m-d');
            $fundAccount->payment_id  = $paymentstudent->id;
            $fundAccount->Debit  =  0.00;
            $fundAccount->Credit  = $request->Debit;
            $fundAccount->description  = $request->description;
            $fundAccount->save();

            DB::commit();
            toastr()->success(trans('messages.update'));
            return redirect()->route('PaymentStudent.index');

        }catch (\Exception $e){

            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy($request)
    {
        PaymentStudent::findOrFail($request->id)->delete();
        toastr()->success(trans('messages.delete'));
        return redirect()->route('PaymentStudent.index');

    }
}
