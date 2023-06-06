@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        {{ trans('Zoom.addnewClass') }}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">  {{ trans('Zoom.addnewClass') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_sidbar.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active"> {{ trans('Zoom.addnewClass') }}</li>
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

                    @if (Session::has('error_promotions'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{Session::get('error_promotions')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form method="post" action="{{route('indirect.store')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{trans('Students_trans.Grade')}}</label>
                                <select class="custom-select mr-sm-2" name="grade_id" required>
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                                @error('grade_id')
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
                                    <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id">

                                    </select>
                                    @error('section_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>رقم الاجتماع : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="meeting_id" type="number">
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>عنوان الحصة : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="topic" type="text">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>تاريخ ووقت الحصة : <span class="text-danger">*</span></label>
                                    <input class="form-control" type="datetime-local" name="start_time">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>مدة الحصة بالدقائق : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="duration" type="number">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>كلمة المرور الاجتماع : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="password" type="text">
                                </div>
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>لينك البدء : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="start_url" type="text">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>لينك الدخول للطلاب : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="join_url" type="text">
                                </div>
                            </div>
                        </div>
                        <br>

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
            $('select[name="grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                const classroomSelect = $('select[name="Classroom_id"]');
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_classrooms') }}/" + Grade_id, // THIS IS ROUTE
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            classroomSelect.empty();
                            classroomSelect.append('<option value="" disabled selected>{{trans('Parent_trans.Choose')}}...</option>');
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
        $(document).ready(() => {
            $('select[name="Classroom_id"]').on('change', () => {
                const classroomId = $('select[name="Classroom_id"]').val();
                if (classroomId) {
                    fetch(`/Get_Sections/${classroomId}`)
                        .then(response => response.json())
                        .then(data => {
                            $('select[name="section_id"]').empty();
                            $.each(data, (key, value) => {
                                $('select[name="section_id"]').append(`<option value="${key}">${value}</option>`);
                            });
                        })
                        .catch(error => {
                            console.error(`Error occurred: ${error}`);
                        });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

@endsection
