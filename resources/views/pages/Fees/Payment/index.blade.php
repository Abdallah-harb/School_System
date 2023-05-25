@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('accounts.payment_student')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('accounts.payment_student')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_sidbar.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('accounts.payment_student')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <br><br>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                        <tr class="alert-success">
                            <th>#</th>
                            <th>{{trans('accounts.student_name')}}</th>
                            <th>{{trans('accounts.amount')}}</th>>
                            <th>{{trans('accounts.notes')}}</th>
                            <th>{{trans('accounts.process')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($paymentStudents as $paymentStudent)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$paymentStudent->student->name}}</td>
                                <td>{{$paymentStudent->amount}}</td>
                                <td>{{$paymentStudent->description}}</td>

                                <td>
                                    <a type="button" class="btn btn-info btn-sm"
                                            href="{{route('PaymentStudent.edit',$paymentStudent->id)}}"
                                            title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete_process{{ $paymentStudent->id }}"
                                            title="{{ trans('Students_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                </td>

                            </tr>

                            <!--delete processing fees -->
                            <div class="modal fade" id="delete_process{{$paymentStudent->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{route('PaymentStudent.destroy','test')}}" method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('accounts.payment_student') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p> {{ trans('accounts.Warning_receipt_student') }}</p>

                                                <input type="hidden" name="id"  value="{{$paymentStudent->id}}">

                                            </div>
                                            <div class="modal-footer">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{ trans('My_Classes_trans.submit') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>



</div>
<!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
