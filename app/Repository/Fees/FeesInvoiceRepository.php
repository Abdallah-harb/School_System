<?php

namespace App\Repository\Fees;

use App\Models\Fee;
use App\Models\Fee_Invoice;
use App\Models\StudentAcount;
use App\Models\Students;
use Illuminate\Support\Facades\DB;

class FeesInvoiceRepository implements FeesInvoiceInterface
{


    public function index()
    {
        $feesInvoices = Fee_Invoice::all();
        $fees = Fee::all();

        return view('pages.FeesInvoices.index',compact('feesInvoices','fees'));

    }

    public function add_fee_student($id)
    {

        $student = Students::findOrFail($id);
        $fees =Fee::where('classroom_id',$student->Classroom_id)->get();
        return view('pages.FeesInvoices.add',compact('student','fees'));

    }
    public function store($request)
    {
       // return $request;
        $fees_lists = $request->List_Fees;
        DB::beginTransaction();
        try {

            foreach ($fees_lists as $fees_list){

                //save on the  fees_invoice الرسوم الدراسيه
                $fees = new  Fee_Invoice();

                $fees->invoice_date         = now()->format('Y-m-d');
                $fees->student_id           = $fees_list['student_id'];
                $fees->Grade_id             = $request->Grade_id ;
                $fees->Classroom_id         = $request->Classroom_id;
                $fees->fee_id               = $fees_list['fee_id'];
                $fees->amount               =  $fees_list['amount'];
                $fees->description          =  $fees_list['description'];

                $fees->save();

                //save on the student account  رسوم الطالب

                $studentAccount = new StudentAcount();

                $studentAccount->date                = now()->format('Y-m-d');
                $studentAccount->type                = "invoice";
                $studentAccount->fee_invoice_id      = $fees->id;
                $studentAccount->student_id          = $fees_list['student_id'];
                $studentAccount->Debit               =  $fees_list['amount'];
                $studentAccount->credit              = 0.00;
                $studentAccount->description         = $fees_list['description'];

                $studentAccount->save();

            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('fees_invoice.index');

        }catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update($request)
    {
        DB::beginTransaction();

        try {

            $fees = Fee_Invoice::findOrFail($request->id);
            $fees->fee_id = $request->fee_id;
            $fees->amount = $request->amount;
            $fees->description = $request->description;

            $fees->save();

            $studentAccount = StudentAcount::where('fee_invoice_id',$request->id)->first();
            $studentAccount->Debit = $request->amount;
            $studentAccount->description = $request->description;

            $studentAccount->save();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('fees_invoice.index');

        }catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function destroy($request)
    {
        Fee_Invoice::findOrFail($request->id)->delete();
        toastr()->success(trans('messages.delete'));
        return redirect()->route('fees_invoice.index');
    }


}
