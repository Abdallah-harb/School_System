@extends('layouts.master')
@section('css')

@section('title')
    {{trans('Students_trans.All_students')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('Students_trans.All_students')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <a href="{{route('students.create')}}" class="btn btn-success btn-sm" role="button"
                               aria-pressed="true">{{ trans('Students_trans.Add_student') }}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                       data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('Students_trans.name')}}</th>
                                        <th>{{trans('Students_trans.email')}}</th>
                                        <th>{{trans('Students_trans.gender')}}</th>
                                        <th>{{trans('Students_trans.Grade')}}</th>
                                        <th>{{trans('Students_trans.classrooms')}}</th>
                                        <th>{{trans('Students_trans.section')}}</th>
                                        <th>{{trans('Students_trans.Processes')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($students as $student)
                                        <tr>

                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->email}}</td>
                                            <td>{{$student->gender->name}}</td>
                                            <td>{{$student->grade->name}}</td>
                                            <td>{{$student->classroom->class_name}}</td>
                                            <td>{{$student->section->section_name}}</td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{trans('Students_trans.Processes')}}
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                                          <a href="{{route('students.edit',$student->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="{{ trans('Students_trans.Edit') }}"><i class="fa fa-edit"></i></a>
                                                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_student{{ $student->id }}" title="{{ trans('Students_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                                          <a href="{{route('students.show',$student->id)}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"title="{{ trans('Students_trans.show') }}"><i class="fa fa-eye"></i></a>
                                                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#graduate_student{{ $student->id }}" title="{{ trans('Students_trans.graduate_student') }}"><i class="fa fa-graduation-cap"></i></button>
                                                          <a class="dropdown-item" href="{{route('fees_invoice.show',$student->id)}}" title=" {{trans('accounts.add_student_fees')}}"><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp; {{trans('accounts.add_student_fees')}}</a>
                                                          <a class="dropdown-item" href="{{route('receipt_student.show',$student->id)}}" title=" {{trans('accounts.receipt_student')}}"><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp; {{trans('accounts.receipt_student')}}</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- model delete teachers -->

                                        <div class="modal fade" id="delete_student{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{route('students.destroy','test')}}" method="post">
                                                    {{method_field('delete')}}
                                                    {{csrf_field()}}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('Teacher_trans.Delete_Teacher') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> {{ trans('My_Classes_trans.Warning_Grade') }}</p>
                                                            <input type="hidden" name="id"  value="{{$student->id}}">

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

                                        <!-- graduate student -->
                                        <div class="modal fade" id="graduate_student{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{route('graduations.store')}}" method="post">
                                                   @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('Students_trans.graduate_student') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> {{ trans('Students_trans.graduate_sure') }}</p>
                                                            <input type="hidden" name="page_id"  value="1">
                                                            <input type="hidden" name="id"  value="{{$student->id}}">

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
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')


@endsection
