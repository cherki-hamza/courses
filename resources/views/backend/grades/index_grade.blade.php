@extends('layouts.master')

@section('css')

@endsection

@section('title')
    {{ __('dashboard.grade_list') }}
@endsection


@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('dashboard.grade_list') }}</h4>
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
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <!--  Start Errors -->
                   @include('backend.errors.errors')
                <!--  End Errors -->

                <div class="row">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                        <div class="card-body">
                            <button type="button" class="button x-small" data-toggle="modal" data-target="#add_modal_Grade">
                                {{ trans('dashboard.add_Grade') }}
                            </button>
                            <br><br>
                            <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('dashboard.Name') }}</th>
                                    <th>{{ __('dashboard.Notes') }}</th>
                                    <th>{{ __('dashboard.Processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @php
                                   $i = 0
                               @endphp
                               @foreach ($gardes as $garde)
                               @php
                                   $i++;
                               @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $garde->name }}</td>
                                    <td>{{ $garde->notes }}</td>
                                     <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit_modal_Grade{{ $garde->id }}"
                                        title="{{ trans('dashboard.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete_modal_Grade{{ $garde->id }}"
                                        title="{{ trans('dashboard.Delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                                </tr>
                                 <!-- start edit_modal_Grade -->
                                    <div class="modal fade" id="edit_modal_Grade{{ $garde->id }}" tabindex="-1" role="dialog" aria-labelledby="edit_modal_Grade"
                                        aria-hidden="true">
                                        <div style="min-width: 700px;" class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="edit_modal_Grade">
                                                        Edit Grade
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">

                                                    <form action="{{ route('grades.update', 'test1') }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="row">
                                                            <div  class="col-md-4">
                                                                <label for="name" class="mr-sm-2">{{ trans('dashboard.stage_name_ar') }}:</label>
                                                                <input dir="rtl" id="name" type="text" name="name_ar" class="form-control" value="{{ $garde->getTranslation('name','ar') }}">
                                                                <input type="hidden" id="id" name="id" value=" {{ $garde->id }} ">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="name_en" class="mr-sm-2">{{ trans('dashboard.stage_name_en') }}:</label>
                                                                <input type="text" class="form-control" name="name_en" value="{{ $garde->getTranslation('name','en') }}">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="name_fr" class="mr-sm-2">{{ trans('dashboard.stage_name_fr') }}:</label>
                                                                <input type="text" class="form-control" name="name_fr" value="{{ $garde->getTranslation('name','fr') }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">

                                                            <div class="tab">
                                                                <ul class="nav nav-tabs" role="tablist">
                                                                    <li class="nav-item">
                                                                    <a class="nav-link show active" id="home-tab" data-bs-toggle="tab" href="#home{{ $garde->id }}" role="tab" aria-controls="home" aria-selected="true">Arabic Notes</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile{{ $garde->id }}" role="tab" aria-controls="profile" aria-selected="false">English Notes</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                    <a class="nav-link" id="portfolio-tab" data-bs-toggle="tab" href="#portfolio{{ $garde->id }}" role="tab" aria-controls="portfolio" aria-selected="false">Franche Notes</a>
                                                                    </li>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane fade active show" id="home{{ $garde->id }}" role="tabpanel" aria-labelledby="home-tab">
                                                                        <p>
                                                                    <label style="font-family: 'Cairo', sans-serif;" for="note">Arabic {{ trans('dashboard.Notes') }}:</label>
                                                                    <textarea dir="rtl" class="form-control" name="note_ar" id="note" rows="3">{{ $garde->getTranslation('notes','ar') }}</textarea>
                                                                    </p>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="profile{{ $garde->id }}" role="tabpanel" aria-labelledby="profile-tab">
                                                                        <p>
                                                                        <label style="font-family: 'Cairo', sans-serif;" for="note">English {{ trans('dashboard.Notes') }}:</label>
                                                                        <textarea class="form-control" name="note_en" id="note" rows="3">{{ $garde->getTranslation('notes','en') }}</textarea>
                                                                        </p>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="portfolio{{ $garde->id }}" role="tabpanel" aria-labelledby="portfolio-tab">
                                                                        <p>
                                                                        <label style="font-family: 'Cairo', sans-serif;" for="note">Franche {{ trans('dashboard.Notes') }}:</label>
                                                                        <textarea class="form-control" name="note_fr" id="note" rows="3">{{ $garde->getTranslation('notes','fr') }}</textarea>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <br><br>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('dashboard.Close') }}</button>
                                                            <button type="submit" class="btn btn-success">Update Grade</button>
                                                        </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                <!-- end edit_modal_Grade -->

                                 <!-- start delete_modal_Grade -->
                                    <div class="modal fade" id="delete_modal_Grade{{ $garde->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title text-danger"
                                                        id="exampleModalLabel">
                                                        Delete Grade
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('grades.destroy', 'delete') }}" method="post">
                                                        @csrf
                                                        {{ method_field('Delete') }}

                                                        {{ trans('dashboard.Warning_Grade') }} [ {{ $garde->name }} ]
                                                        <input id="grade_id" type="hidden" name="grade_id" class="form-control"
                                                            value="{{ $garde->id }}">
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
                                    <!-- end delete_modal_Grade -->

                              @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('dashboard.Name') }}</th>
                                    <th>{{ __('dashboard.Notes') }}</th>
                                    <th>{{ __('dashboard.Processes') }}</th>
                                </tr>
                            </tfoot>

                        </table>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

         <!-- start add_modal_Grade -->
            <div class="modal fade" id="add_modal_Grade" tabindex="-1" role="dialog" aria-labelledby="add_modal_Grade"
                aria-hidden="true">
                <div style="min-width: 700px;" class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="add_modal_Grade">
                                {{ trans('dashboard.add_Grade') }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">

                            <form action="{{ route('grades.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div  class="col-md-4">
                                        <label for="name" class="mr-sm-2">{{ trans('dashboard.stage_name_ar') }}:</label>
                                        <input dir="rtl" id="name" type="text" name="name_ar" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name_en" class="mr-sm-2">{{ trans('dashboard.stage_name_en') }}:</label>
                                        <input type="text" class="form-control" name="name_en">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name_fr" class="mr-sm-2">{{ trans('dashboard.stage_name_fr') }}:</label>
                                        <input type="text" class="form-control" name="name_fr">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="tab">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                            <a class="nav-link show active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Arabic Notes</a>
                                            </li>
                                            <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">English Notes</a>
                                            </li>
                                            <li class="nav-item">
                                            <a class="nav-link" id="portfolio-tab" data-bs-toggle="tab" href="#portfolio" role="tab" aria-controls="portfolio" aria-selected="false">Franche Notes</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                <p>
                                             <label style="font-family: 'Cairo', sans-serif;" for="note">Arabic {{ trans('dashboard.Notes') }}:</label>
                                             <textarea dir="rtl" class="form-control" name="note_ar" id="note" rows="3"></textarea>
                                             </p>
                                            </div>
                                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                <p>
                                                <label style="font-family: 'Cairo', sans-serif;" for="note">English {{ trans('dashboard.Notes') }}:</label>
                                                <textarea class="form-control" name="note_en" id="note" rows="3"></textarea>
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="portfolio" role="tabpanel" aria-labelledby="portfolio-tab">
                                                <p>
                                                <label style="font-family: 'Cairo', sans-serif;" for="note">Franche {{ trans('dashboard.Notes') }}:</label>
                                                <textarea class="form-control" name="note_fr" id="note" rows="3"></textarea>
                                                </p>
                                            </div>
                                        </div>
                                      </div>

                                </div>

                                <br><br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('dashboard.Close') }}</button>
                                    <button type="submit" class="btn btn-success">{{ trans('dashboard.submit') }}</button>
                                </div>
                        </form>

                    </div>
                </div>
            </div>
         <!-- end add_modal_Grade -->

</div>
<!-- row closed -->
@endsection

@section('js')

@endsection
