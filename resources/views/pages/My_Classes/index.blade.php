@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        {{ trans('My_Classes_trans.title_page') }}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{ trans('My_Classes_trans.title_page') }}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('My_Classes_trans.add_class') }} <i class="fa fa-plus"></i>
                    </button>
                        <button type="button" class="button x-small" id="btn_delete_all">
                            {{ trans('My_Classes_trans.delete_checkbox') }}
                        </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('My_Classes_trans.Name_class') }}</th>
                                <th>{{ trans('My_Classes_trans.Name_Grade') }}</th>
                                <th>{{ trans('My_Classes_trans.Processes') }}</th>
                                <th> <button id="check-all-button" class="btn btn-danger">{{ trans('My_Classes_trans.Check_All') }}</button></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>


                                @foreach($classes as $class)
                                    <?php $i++; ?>
                                    <tr>

                                        <td>{{$i}}</td>
                                        <td>{{$class->class_name}}</td>
                                        <td>{{$class->grades->name}}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#edit{{$class->id}}"
                                                    title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete{{$class->id}}"
                                                    title="{{ trans('Grades_trans.Delete') }}"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" name="checkbox1" value="{{$class->id}}" id="checkbox1">
                                        </td>
                                    </tr>

                                    <!-- edit_modal_Grade -->
                                    <div class="modal fade" id="edit{{$class->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

                                                    <form class=" row mb-30" action="{{route('classroom.update','test')}}" method="POST">
                                                        {{method_field('patch')}}
                                                        @csrf
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                               value="{{ $class->id }}">
                                                        <div class="card-body">
                                                                        <div class="row">

                                                                            <div class="col-sm">
                                                                                <label for="class_name"
                                                                                       class="mr-sm-2">{{ trans('My_Classes_trans.Name_class') }}
                                                                                    :</label>
                                                                                <input class="form-control" type="text" name="class_name"
                                                                                       value="{{$class->getTranslation('class_name','ar')}}"/>
                                                                            </div>


                                                                            <div class="col-sm">

                                                                                <label for="class_name"
                                                                                           class="mr-sm-2">{{ trans('My_Classes_trans.Name_class_en') }}
                                                                                        :</label>
                                                                                    <input class="form-control" type="text" name="class_name_en"
                                                                                           value="{{$class->getTranslation('class_name','en')}}"/>
                                                                            </div>


                                                                            <div class="col-sm">
                                                                                <label for="grade_id"
                                                                                       class="mr-sm-2">{{ trans('My_Classes_trans.Name_Grade') }}
                                                                                    :</label>

                                                                                <div class="box">
                                                                                    <select class="fancyselect" name="grade_id" >
                                                                                        @isset($Grades)
                                                                                            @foreach ($Grades as $Grade)
                                                                                                <option value="{{$Grade->id}}" @if($class->grades->id == $Grade->id) selected @endif >{{ $Grade->name}}</option>
                                                                                            @endforeach
                                                                                        @endisset
                                                                                    </select>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                <div class="row mt-20">
                                                                    <div class="col-12">
                                                                        <input class="button" data-repeater-create type="button" value="{{ trans('My_Classes_trans.add_row') }}"/>
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
                                    <!-- grade delete model -->
                                    <div class="modal fade" id="delete{{ $class->id }}" tabindex="-1" role="dialog"
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
                                                    <form action="{{route('classroom.destroy','test')}}" method="post">
                                                        {{method_field('Delete')}}
                                                        @csrf
                                                        {{ trans('grade.Warning_Grade') }} .!
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                               value="{{ $class->id }}">
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


        <!-- add_modal_class -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

                        <form class=" row mb-30" action="{{route('classroom.store')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="repeater">
                                    <div data-repeater-list="List_Classes"> <!-- List_Classes => array that use to form repeater and use it on store and make validation  -->
                                        <div data-repeater-item>
                                            <div class="row">

                                                <div class="col">
                                                    <label for="class_name"
                                                           class="mr-sm-2">{{ trans('My_Classes_trans.Name_class') }}
                                                        :</label>
                                                    <input class="form-control" type="text" name="class_name" />
                                                </div>


                                                <div class="col">
                                                    <label for="class_name"
                                                           class="mr-sm-2">{{ trans('My_Classes_trans.Name_class_en') }}
                                                        :</label>
                                                    <input class="form-control" type="text" name="class_name_en" />
                                                </div>


                                                <div class="col">
                                                    <label for="grade_id"
                                                           class="mr-sm-2">{{ trans('My_Classes_trans.Name_Grade') }}
                                                        :</label>

                                                    <div class="box">
                                                        <select class="fancyselect" name="grade_id" >
                                                            @isset($Grades)
                                                                @foreach ($Grades as $Grade)
                                                                    <option value="{{ $Grade->id }}" >{{ $Grade->name}}</option>
                                                                @endforeach
                                                            @endisset
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="col">
                                                    <label for="Name_en"
                                                           class="mr-sm-2">{{ trans('My_Classes_trans.Processes') }}
                                                        :</label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete
                                                           type="button" value="{{ trans('My_Classes_trans.delete_row') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button" value="{{ trans('My_Classes_trans.add_row') }}"/>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('grade.Close') }}</button>
                                        <button type="submit"
                                                class="btn btn-success">{{ trans('grade.submit') }}</button>
                                    </div>


                                </div>
                            </div>
                        </form>
                    </div>


                </div>

            </div>

        </div>

        <!-- حذف مجموعة صفوف -->
        <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('My_Classes_trans.delete_class') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('delete_all') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            {{ trans('My_Classes_trans.Warning_Grade') }}
                            <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                            <button type="submit" class="btn btn-danger">{{ trans('My_Classes_trans.submit') }}</button>
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
    <script>
        document.getElementById("check-all-button").addEventListener("click", function() {
            // Get all checkboxes on the page
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');

            // Check or uncheck all checkboxes depending on their current state
            var allChecked = true;
            for (var i = 0; i < checkboxes.length; i++) {
                if (!checkboxes[i].checked) {
                    allChecked = false;
                    checkboxes[i].checked = true;
                } else {
                    checkboxes[i].checked = false;
                }
            }

            // Update the button text depending on the checkbox state
            if (allChecked) {
                this.innerHTML = "{{ trans('My_Classes_trans.Check_All') }}";
            } else {
                this.innerHTML = "{{ trans('My_Classes_trans.Un_Check_All') }}";
            }
        });
        $(function() {
            $("#btn_delete_all").click(function() {
                var selected = new Array();
                $("#datatable input[type=checkbox]:checked").each(function() {
                    selected.push(this.value);
                });
                if (selected.length > 0) {
                    $('#delete_all').modal('show')
                    $('input[id="delete_all_id"]').val(selected);
                }
            });
        });
    </script>
@endsection
