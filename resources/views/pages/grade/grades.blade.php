@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    Grade List
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('main_sidbar.Grade_list')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('main_sidbar.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('main_sidbar.Grade_list')}}</li>
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
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('grade.add_Grade') }} <i class="fa fa-plus"></i>
                </button>

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
                        <tr>
                            <th>#</th>
                            <th>{{trans('grade.name')}}</th>
                            <th>{{trans('grade.notes')}}</th>
                            <th>{{trans('grade.process')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0;?>
                        @foreach($grades as $grade)
                            <?php $i++; ?>
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$grade->name}}</td>
                                <td>{{$grade->notes}}</td>
                                <td>

                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $grade->id }}"
                                            title="{{trans('grade.edit')}}"><i
                                            class="fa fa-edit"></i>{{trans('grade.edit')}} </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $grade->id }}"
                                            title="{{trans('grade.delete')}}"><i
                                            class="fa fa-trash"></i>{{trans('grade.delete')}}</button>
                                </td>
                            </tr>

                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('grade.edit_Grade') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{route('grade.update','test')}}" method="post">
                                                {{method_field('patch')}}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $grade->id }}">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="name"
                                                               class="mr-sm-2">{{ trans('grade.stage_name_ar') }}
                                                            :</label>
                                                        <input id="name" type="text" name="name"
                                                               class="form-control"
                                                               value="{{$grade->getTranslation('name','ar')}}"
                                                               required>

                                                    </div>
                                                    <div class="col">
                                                        <label for="name_en"
                                                               class="mr-sm-2">{{ trans('grade.stage_name_en') }}
                                                            :</label>
                                                        <input type="text" class="form-control"
                                                               value="{{$grade->getTranslation('name','en')}}"
                                                               name="name_en" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="exampleFormControlTextarea1">{{ trans('grade.Notes') }}
                                                        :</label>
                                                    <textarea class="form-control" name="notes"
                                                              id="exampleFormControlTextarea1"
                                                              rows="3">{{ $grade->notes }}</textarea>
                                                </div>
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('grade.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-success">{{ trans('grade.submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- grade delete model -->
                            <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('grade.delete_Grade') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('grade.destroy','test')}}" method="post">
                                                {{method_field('Delete')}}
                                                @csrf
                                                {{ trans('grade.Warning_Grade') }} .!
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $grade->id }}">
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

    <!-- add_modal_Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                        id="exampleModalLabel">
                        {{ trans('grade.add_Grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{route('grade.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="Name"
                                       class="mr-sm-2">{{ trans('grade.stage_name_ar') }}
                                    :</label>
                                <input id="name" type="text" name="name" class="form-control" value="{{old('name')}}">
                            </div>
                            <div class="col">
                                <label for="name_en"
                                       class="mr-sm-2">{{ trans('grade.stage_name_en') }}
                                    :</label>
                                <input type="text" class="form-control" name="name_en" required value="{{old('name_en')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label
                                for="exampleFormControlTextarea1">{{ trans('grade.Notes') }}
                                :</label>
                            <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                                      rows="3"></textarea>
                        </div>
                        <br><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"> <i class="fa-solid fa-xmark"></i>{{ trans('grade.Close') }}</button>
                    <button type="submit"
                            class="btn btn-success">{{ trans('grade.submit') }}</button>
                </div>
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
