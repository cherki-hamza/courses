@extends('layouts.master')
@section('css')
   {{-- <link href=" https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css " rel="stylesheet"> --}}
@endsection

@section('title')
    {{ __('dashboard.grade_list') }}
@stop



@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('dashboard.grade_list') }}  {!! (request()->route()->getName() === 'Filter_Classes')? "<strong class='text-success'> Filtred By  $grade_name->name </strong>" : "" !!} </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}" class="default-color">{{ __('dashboard.dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ __('dashboard.grade_list') }}</li>
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

            <!--  Start Errors -->
               @include('backend.errors.errors')
            <!--  End Errors -->

            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ trans('dashboard.add_class') }}
            </button>

                <button type="button" class="button x-small" id="btn_delete_all">
                    {{ trans('dashboard.delete_checkbox') }}
                </button>


            <br><br>

                <!-- start Filter_Classes -->
                <form action="{{ route('Filter_Classes') }} " method="POST">
                    {{ csrf_field() }}
                    <select class="selectpicker" data-style="btn-info" name="grade_id" required
                            onchange="this.form.submit()">
                        <option value="" selected disabled>{{ trans('dashboard.Search_By_Grade') }}</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                </form>
                <!-- end Filter_Classes -->



            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                            <th>#</th>
                            <th>{{ trans('dashboard.Name_class') }}</th>
                            <th>{{ trans('dashboard.Name_grade') }}</th>
                            <th>{{ trans('dashboard.Processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                    @if (isset($details))

                        <?php $List_Classes = $details ?>


                    @endif

                        <?php $i = 0; ?>

                        @foreach ($List_Classes as $My_Class)
                            <tr>
                                <?php $i++; ?>
                                <td><input type="checkbox"  value="{{ $My_Class->id }}" class="box1" ></td>
                                <td>{{ $i }}</td>
                                <td>{{ $My_Class->Name_Class }}</td>
                                <td>{{ $My_Class->Grades->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $My_Class->id }}"
                                        title="{{ trans('dashboard.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $My_Class->id }}"
                                        title="{{ trans('dashboard.Delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <!-- start edit_modal_grade -->
                            <div class="modal fade" id="edit{{ $My_Class->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('dashboard.edit_class') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- edit_form -->
                                            <form action="{{ route('classrooms.update', 'test_update') }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="name_class_ar"
                                                               class="mr-sm-2">Arabic class Name :</label>
                                                        <input id="name_class_ar" type="text" name="name_class_ar"
                                                               class="form-control"
                                                               value="{{ $My_Class->getTranslation('Name_Class', 'ar') }}"
                                                               required>
                                                        <input id="class_room_id" type="hidden" name="class_room_id" class="form-control"
                                                               value="{{ $My_Class->id }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="name_class_en"
                                                               class="mr-sm-2">English class Name :</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ $My_Class->getTranslation('Name_Class', 'en') }}"
                                                               name="name_class_en" required>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label
                                                        for="grade_id">Grade Name  :</label>
                                                    <select style="height: 50px;" class="form-control form-control-lg" id="grade_id" name="grade_id">
                                                        <option value="{{ $My_Class->Grades->id }}">
                                                            {{ $My_Class->Grades->name }}
                                                        </option>
                                                        @foreach ($grades as $grade)
                                                            <option value="{{ $grade->id }}">
                                                                {{ $grade->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('dashboard.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-success">{{ trans('dashboard.submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end edit_modal_grade -->


                            <!-- start delete_modal_grade -->
                            <div class="modal fade" id="delete{{ $My_Class->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('dashboard.delete_class') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('classrooms.destroy', 'test') }}"
                                                  method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('dashboard.Warning_grade') }}
                                                <input id="class_room_id" type="hidden" name="class_room_id" class="form-control"
                                                       value="{{ $My_Class->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('dashboard.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{ trans('dashboard.submit') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end delete_modal_grade -->

                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


<!-- start add_modal_class -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div style="min-width: 800px;" class="modal-dialog modal-lg">
        <div  class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('dashboard.add_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{ route('classrooms.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                    <div class="row">

                                        <div class="col">
                                            <label for="name_class_ar" class="mr-sm-2">Arabic class Name :</label>
                                            <input class="form-control" type="text" name="name_class_ar" />
                                        </div>


                                        <div class="col">
                                            <label for="name_class_en" class="mr-sm-2">English class Name :</label>
                                            <input class="form-control" type="text" name="name_class_en" />
                                        </div>


                                        <div class="col">
                                            <label for="grade_id" class="mr-sm-2">Grade Name  :</label>
                                            <div class="box">
                                                <select class="fancyselect" name="grade_id">
                                                    <option value="">Select Grade</option>
                                                    @foreach ($grades as $grade)
                                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label for="class_name" class="mr-sm-2">{{ trans('dashboard.Processes') }}  :</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete type="button" value="{{ trans('dashboard.delete_row') }}" />
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button" value="{{ trans('dashboard.add_row') }}"/>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('dashboard.Close') }}</button>
                                <button type="submit" class="btn btn-success">{{ trans('dashboard.submit') }}</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>

</div>
<!-- end add_modal_class -->


<!-- start delete class -->
<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('dashboard.delete_class') }}
                </h5>
                <button id="modal_clos2" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('delete_all') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    {{ trans('dashboard.Warning_grade') }}
                    <input class="text" type="text" id="delete_all_id" name="delete_all_id" value=''>
                </div>

                <div class="modal-footer">
                    <button id="modal_clos" type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('dashboard.Close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ trans('dashboard.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end delete class -->



</div>
<!-- end row -->


<!-- row closed -->
@endsection


@section('js')



<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            let selected = [];
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);

            });

            selected = selected.filter(e => e !== 'on');


            console.log(selected);

            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);

            }

            $("#modal_clos").click(function(){
                $("#delete_all").modal("hide");
            });

             $("#modal_clos2").click(function(){
                $("#delete_all").modal("hide");
            });

        });
    });

</script>
@endsection
