@extends('layouts.master')
@section('css')

    @section('title')
        {{trans('Zoom.Online_classes')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('Zoom.Online_classes')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_sidbar.Dashboard')}}</a></li>
                    <li class="breadcrumb-item active"> {{trans('Zoom.Online_classes')}}</li>
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
                                <a href="{{route('online_classes.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ trans('Zoom.addnewClass') }}</a>
                                <a href="{{route('indirect.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">اضافة حصة اوفلاين جديدة</a>
                                <br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('Students_trans.section')}}</th>
                                            <th>{{trans('Subjects.teacher')}}</th>
                                            <th>{{trans('Zoom.Class')}}</th>
                                            <th>{{trans('Zoom.Strart')}}</th>
                                            <th>{{trans('Zoom.Class_time')}}</th>
                                            <th>{{trans('Zoom.Class_link')}}</th>
                                            <th>{{trans('Zoom.process')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($onlineClasses as $onlinclass)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$onlinclass->grade->name}}</td>
                                                <td>{{$onlinclass->classroom->class_name}}</td>
                                                <td>{{$onlinclass->section->section_name}}</td>
                                                <td>{{$onlinclass->user->name}}</td>
                                                <td>{{$onlinclass->topic}}</td>
                                                <td>{{$onlinclass->start_at}}</td>
                                                <td>{{$onlinclass->duration}}</td>
                                                <td class="text-danger"><a href="{{$onlinclass->join_url}}" target="_blank">أنضم ألان</a></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#delete{{ $onlinclass->id }}"
                                                            title="{{trans('grade.delete')}}"><i
                                                            class="fa fa-trash"></i>
                                                    </button>
                                                </td>

                                            </tr>


                                            <!-- grade delete model -->
                                            <div class="modal fade" id="delete{{ $onlinclass->id }}" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                id="exampleModalLabel">
                                                                {{ trans('Zoom.delete_meeting') }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('online_classes.destroy',$onlinclass->meeting_id)}}" method="post">
                                                                {{method_field('Delete')}}
                                                                @csrf
                                                                {{ trans('Zoom.Warning_Grade') }} .!
                                                                <input id="id" type="hidden" name="id" class="form-control"
                                                                       value="{{ $onlinclass->meeting_id }}">
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
