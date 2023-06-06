@extends('layouts.master')
@section('css')

    @section('title')
       المكتبه
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> المكتبه الدراسيه</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_sidbar.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">المكتبه الدراسيه</li>
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
                                <a href="{{route('library.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">أضافه كتاب </a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>اسم الكتاب</th>
                                            <th>المعلم</th>
                                            <th></th>
                                            <th>المرحله الدراسيه</th>
                                            <th>الفصل الدراسى</th>
                                            <th>{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($libraries as $library)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$library->book_name}}</td>
                                                <td>{{auth()->user()->name}}</td>
                                                <td></td>
                                                <td>{{$library->grade->name}}</td>
                                                <td>{{$library->classroom->class_name}}</td>
                                                <td>
                                                    <a href="{{route('download_book',$library->file_book)}}" title="تحميل الكتاب" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fas fa-download"></i></a>
                                                    <a href="" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="{{ trans('Students_trans.Edit') }}"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_subject" title="{{ trans('Students_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                                </td>

                                            </tr>

                                            <!-- Subject delete model -->
                                            <div class="modal fade" id="delete_subject" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                id="exampleModalLabel">
                                                                {{ trans('Subjects.delete_Subjects') }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="post">
                                                                {{method_field('Delete')}}
                                                                @csrf
                                                                {{ trans('Subjects.Warning_Subjects') }} .!
                                                                <input id="id" type="hidden" name="id" class="form-control"
                                                                       value="">
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
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')


@endsection
