@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        {{trans('Attendance.attendance')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('Attendance.attendance')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_sidbar.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('Attendance.attendance')}}</li>
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

                    <form method="POST" action="{{route('attendance.store')}}">
                        @csrf
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered p-0">
                                <thead>
                                <tr class="alert-success">
                                    <th>#</th>
                                    <th>{{trans('Students_trans.name')}}</th>
                                    <th>{{trans('Students_trans.email')}}</th>
                                    <th>{{trans('Students_trans.Grade')}}</th>
                                    <th>{{trans('Students_trans.classrooms')}}</th>
                                    <th>{{trans('Students_trans.section')}}</th>
                                    <th>{{trans('Students_trans.Processes')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$student->name}}</td>
                                        <td>{{$student->email}}</td>
                                        <td>{{$student->grade->name}}</td>
                                        <td>{{$student->classroom->class_name}}</td>
                                        <td>{{$student->section->section_name}}</td>

                                        <td>
                                            @if(isset($student->attendance->where('attendance_date',date('Y-m-d'))->first()->student_id))

                                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                                    <input name="attendences[{{ $student->id }}]" disabled
                                                           {{$student->attendance->where('attendance_date',date('Y-m-d'))->first()->attendance_status == 1? 'checked' : ''}}
                                                           class="leading-tight" type="radio" value="presence">
                                                    <span class="text-success">حضور</span>
                                                </label>

                                                <label class="ml-4 block text-gray-500 font-semibold">
                                                    <input name="attendences[{{ $student->id }}]" disabled
                                                           {{$student->attendance->where('attendance_date',date('Y-m-d'))->first()->attendance_status == 0? 'checked' : ''}}
                                                           class="leading-tight" type="radio" value="absent">
                                                    <span class="text-danger">غياب</span>
                                                </label>
                                            @else
                                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                                    <input name="attendences[{{ $student->id }}]"
                                                           class="leading-tight" type="radio" value="presence">
                                                    <span class="text-success">حضور</span>
                                                </label>

                                                <label class="ml-4 block text-gray-500 font-semibold">
                                                    <input name="attendences[{{ $student->id }}]"
                                                           class="leading-tight" type="radio" value="absent">
                                                    <span class="text-danger">غياب</span>
                                                </label>
                                            @endif

                                        </td>

                                    </tr>


                                @endforeach

                            </table>
                        </div>
                        <input type="hidden" name="studen_id[]" value="{{ $student->id }}">
                        <input type="hidden" name="grade_id"    value="{{ $student->Grade_id }}">
                        <input type="hidden" name="Classroom_id" value="{{ $student->Classroom_id }}">
                        <input type="hidden" name="section_id" value="{{ $student->section_id }}">
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>

                    </form>



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
