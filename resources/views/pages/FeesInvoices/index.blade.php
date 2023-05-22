@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('accounts.accounts')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('accounts.accounts')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_sidbar.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('accounts.accounts')}}</li>
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
                <a href="{{route('fees.create')}}" class="btn btn-success btn-sm" role="button"
                   aria-pressed="true">{{ trans('accounts.add_fees') }}</a><br><br>

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
                            <th>{{trans('accounts.type')}}</th>
                            <th>{{trans('accounts.amount')}}</th>
                            <th>{{trans('Students_trans.Grade')}}</th>
                            <th>{{trans('Students_trans.classrooms')}}</th>
                            <th>{{trans('accounts.notes')}}</th>
                            <th>{{trans('accounts.process')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($feesInvoices as $feesInvoice)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$feesInvoice->student->name}}</td>
                                <td>{{$feesInvoice->fee->title}}</td>
                                <td>{{$feesInvoice->amount}}</td>
                                <td>{{$feesInvoice->grade->name}}</td>
                                <td>{{$feesInvoice->classroom->class_name}}</td>
                                <td>{{$feesInvoice->description}}</td>

                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{$feesInvoice->id}}"
                                            title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete_fees{{ $feesInvoice->id }}"
                                            title="{{ trans('Students_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                </td>

                            </tr>


                            <!-- edit feesInvoices -->
                            <div class="modal fade" id="edit{{$feesInvoice->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{ trans('My_Classes_trans.add_class') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form class=" row mb-30" action="{{route('fees_invoice.update','test')}}" method="POST">
                                                {{method_field('patch')}}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $feesInvoice->id }}">
                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-sm">
                                                            <label for="student_id "
                                                                   class="mr-sm-2">{{ trans('My_Classes_trans.Name_class') }}
                                                                :</label>
                                                            <input type="text" value="{{$feesInvoice->student->name}}" readonly name="title_ar" class="form-control">

                                                        </div>


                                                        <div class="col-sm">
                                                            <label for="Name_en" class="mr-sm-2">{{trans('accounts.amount')}}</label>
                                                            <div class="box">
                                                                <select class="fancyselect" name="amount" required>
                                                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                                                    @foreach($fees as $fee)
                                                                        <option value="{{$fee->amount}}" @if($feesInvoice->fee_id  == $fee->id) selected @endif >{{ $fee->amount}}</option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <label for="Name_en" class="mr-sm-2">{{trans('accounts.type')}}</label>
                                                            <div class="box">
                                                                <select class="fancyselect" name="fee_id" required>
                                                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                                                    @foreach($fees as $fee)
                                                                        <option value="{{$fee->id}}" @if($feesInvoice->fee_id  == $fee->id) selected @endif >{{ $fee->title}}</option>

                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="col">
                                                        <label for="description" class="mr-sm-2">{{trans('accounts.notes')}}</label>
                                                        <div class="box">
                                                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{$feesInvoice->description}}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('grade.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-success">{{ trans('grade.submit') }}</button>
                                                    </div>


                                                </div>
                                            </form>
                                        </div>


                                    </div>

                                </div>

                            </div>

                            <!-- delete feesInvoices -->
                            <div class="modal fade" id="delete_fees{{ $feesInvoice->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('accounts.Delete_fees') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('fees_invoice.destroy','test')}}" method="post">
                                                {{method_field('Delete')}}
                                                @csrf
                                                {{ trans('accounts.Warning_fees') }} .!
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $feesInvoice->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('grade.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{ trans('grade.submit') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
