@extends('layouts.master')
@section('css')

@section('title')
    {{trans('Students_trans.promotion_management')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('Students_trans.promotion_management')}}</h4>
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
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_Teacher" title="{{ trans('Students_trans.Rollback') }}"><i class="fa fa-trash"></i> {{ trans('Students_trans.Rollback') }}</button>
                            <br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                       data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('Students_trans.name')}}</th>
                                        <th class="alert-danger">{{trans('Students_trans.From_Grade')}}</th>
                                        <th class="alert-danger">{{trans('Students_trans.From_classrooms')}}</th>
                                        <th class="alert-danger">{{trans('Students_trans.From_section')}}</th>
                                        <th class="alert-success">{{trans('Students_trans.to_Grade')}}</th>
                                        <th class="alert-success">{{trans('Students_trans.To_classrooms')}}</th>
                                        <th class="alert-success">{{trans('Students_trans.To_section')}}</th>
                                        <th>{{trans('Students_trans.Processes')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($promotions as $promotion)
                                        <tr>

                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$promotion->student->name}}</td>
                                            <td>{{$promotion->f_garde->name}}</td>
                                            <td>{{$promotion->f_classroom->class_name}}</td>
                                            <td>{{$promotion->f_section->section_name}}</td>
                                            <td>{{$promotion->t_garde->name}}</td>
                                            <td>{{$promotion->t_classroom->class_name}}</td>
                                            <td>{{$promotion->t_section->section_name}}</td>
                                            <td>
                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#roolbackstudent{{$promotion->id}}">{{trans('Students_trans.rollback_student')}}</button>
                                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#">{{trans('Students_trans.graduate_student')}}</button>
                                            </td>
                                        </tr>

                                        <!-- model rollback promotion students teachers -->

                                        <div class="modal fade" id="roolbackstudent{{$promotion->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{route('promotion.destroy','test')}}" method="post">
                                                    {{method_field('delete')}}
                                                    {{csrf_field()}}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('Students_trans.Rollback') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> {{ trans('Students_trans.Warning_promotion') }}</p>
                                                            <input type="hidden" name="id"  value="{{$promotion->id}}">

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





<!-- model delete teachers -->

<div class="modal fade" id="delete_Teacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('promotion.destroy','test')}}" method="post">
            {{method_field('delete')}}
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('Students_trans.Rollback') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> {{ trans('Students_trans.Warning_promotion') }}</p>
                    <input type="hidden" name="page_id"  value="1">

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

<!-- row closed -->
@endsection
@section('js')


@endsection
