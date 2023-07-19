@extends('layouts.master')

@section('css')

@endsection

@section('title')
{{ __('dashboard.section') }}
@stop


@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('dashboard.List_sections') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}" class="default-color">{{
                        __('dashboard.dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ __('dashboard.List_sections') }}</li>
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
                <a class="button x-small" href="#" data-toggle="modal" data-target="#add_new_section">
                    {{ trans('dashboard.add_section') }}</a>
            </div>

            <!--  Start Errors -->
            @include('backend.errors.errors')
            <!--  End Errors -->

            <div class="card card-statistics h-100">

                <div class="card-body">
                    <div class="accordion gray plus-icon round">

                        @foreach ($grades as $Grade)

                        <div class="acd-group">
                            <a href="#" class="acd-heading">{{ $Grade->name }}</a>
                            <div class="acd-des">

                                <div class="row">
                                    <div class="col-xl-12 mb-30">
                                        <div class="card card-statistics h-100">
                                            <div class="card-body">
                                                <div class="d-block d-md-flex justify-content-between">
                                                    <div class="d-block">
                                                    </div>
                                                </div>
                                                <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0">
                                                        <thead>
                                                            <tr class="text-dark">
                                                                <th>#</th>
                                                                <th>{{ trans('dashboard.Name_Section') }}
                                                                </th>
                                                                <th>{{ trans('dashboard.Name_Class') }}</th>
                                                                <th>{{ trans('dashboard.Status') }}</th>
                                                                <th>{{ trans('dashboard.Processes') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 0; ?>
                                                            @foreach ($Grade->sections as $list_section)
                                                            <tr>
                                                                <?php $i++; ?>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $list_section->section_name }}</td>
                                                                <td>{{ $list_section->classroom->Name_Class }}
                                                                </td>
                                                                <td>
                                                                    @if ($list_section->section_status === 1)
                                                                    <label class="badge badge-success">{{
                                                                        trans('dashboard.Status_Section_AC') }}</label>
                                                                    @else
                                                                    <label class="badge badge-danger">{{
                                                                        trans('dashboard.Status_Section_No') }}</label>
                                                                    @endif

                                                                </td>
                                                                <td>

                                                                    <a href="#" class="btn btn-outline-info btn-sm"
                                                                        data-toggle="modal"
                                                                        data-target="#edit{{ $list_section->id }}">{{
                                                                        trans('dashboard.Edit') }}</a>
                                                                    <a href="#" class="btn btn-outline-danger btn-sm"
                                                                        data-toggle="modal"
                                                                        data-target="#delete{{ $list_section->id }}">{{
                                                                        trans('dashboard.Delete') }}</a>
                                                                </td>
                                                            </tr>


                                                            <!--  Start Edit Section -->
                                                            @include('backend.section.modal_edit_section')
                                                            <!--  End Edit Section -->


                                                            <!-- Start Delete Section -->
                                                            @include('backend.section.modal_delete_section')
                                                            <!-- End Delete Section -->

                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        @endforeach


                    </div>
                </div>

            </div>

        </div>
    </div>

    <!--  start add new section -->
    @include('backend.section.modal_add_new_section')
    <!--  end add new section -->

</div>
<!-- row closed -->
@endsection

@section('js')

<script>
    $(document).ready(function(){

       $('select[name="Grade_id"]').on('change', function(){

          let grade_id = $(this).val();
          console.log(grade_id);
           if(grade_id){
            var url = '{{ route("classes", ":id") }}';
              url = url.replace(':id', grade_id);
              $.ajax({
                 url: url,
                 type: "GET",
                 dataType: "json",
                 success: function(data){
                    console.log(data);
                      $('select[name="Class_id"]').empty();
                      $.each(data, function(key, value){
                           $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
                      });
                 }
              });
           }else{
              console.log('AJAX LOAD DID NOT WORK');
           }

       });

    });
</script>
@endsection
