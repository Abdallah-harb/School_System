@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        {{trans('accounts.add_fees')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('accounts.add_fees')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if (Session::has('error_promotions'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{Session::get('error_promotions')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form method="post" action="{{ route('fees.store')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{trans('accounts.title_ar')}}</label>
                                <input type="text"  name="title_ar" class="form-control" >
                                @error('title_ar')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{trans('accounts.title_en')}} : <span
                                        class="text-danger">*</span></label>
                                <input type="text"  name="title_en" class="form-control" >
                                @error('title_en')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group col">
                                <label for="section_id">{{trans('accounts.amount')}} : </label>
                                <input type="text"  name="amount" class="form-control" >
                                @error('amount')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{trans('Students_trans.Grade')}}</label>
                                <select class="custom-select mr-sm-2" name="Grade_id" required>
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($Grades as $Grade)
                                        <option value="{{$Grade->id}}">{{$Grade->name}}</option>
                                    @endforeach
                                </select>
                                @error('Grade_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{trans('Students_trans.classrooms')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Classroom_id" required>

                                </select>
                                @error('Classroom_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group col">
                                <label for="section_id">{{trans('accounts.years')}} : </label>
                                <select class="custom-select mr-sm-2" name="year">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @php
                                        $current_year = date("Y");
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}">{{ $year }}</option>
                                    @endfor
                                </select>
                                @error('year')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group col">
                                <label for="section_id">{{trans('accounts.type')}} : </label>
                                <select class="custom-select mr-sm-2" name="fee_type" required>
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    <option value="1">{{trans('accounts.study_fees')}}</option>
                                    <option value="2">{{trans('accounts.bus')}}</option>
                                </select>
                                @error('fee_type')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group">
                            <label
                                for="exampleFormControlTextarea1">{{ trans('grade.Notes') }}
                                :</label>
                            <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                                      rows="3"></textarea>
                            @error('notes')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">{{trans('Students_trans.submit')}}</button>
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

    <script>
        $(document).ready(function () {
            $('select[name="Grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                const classroomSelect = $('select[name="Classroom_id"]');
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_classrooms') }}/" + Grade_id, // THIS IS ROUTE
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            classroomSelect.empty();
                            classroomSelect.append('<option value="" disabled>{{trans('Parent_trans.Choose')}}...</option>');
                            $.each(data, function (key, value) {
                                const option = $('<option></option>').attr('value', key).text(value);
                                classroomSelect.append(option);
                            });

                        },
                    });
                }

                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('select[name="Classroom_id"]').on('change', function () {
                var Classroom_id = $(this).val();
                const section_id = $('select[name="section_id"]');
                if (Classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_Sections') }}/" + Classroom_id, // THIS IS ROUTE
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            section_id.empty();
                            section_id.append('<option value="" disabled>{{trans('Parent_trans.Choose')}}...</option>');
                            $.each(data, function (key, value) {
                                const option = $('<option></option>').attr('value', key).text(value);
                                section_id.append(option);
                            });

                        },
                    });
                }

                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

@endsection
