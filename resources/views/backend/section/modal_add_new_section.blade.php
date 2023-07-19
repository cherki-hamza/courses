<div class="modal fade" id="add_new_section" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                    {{ trans('dashboard.add_section') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('sections.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col">
                            <input type="text" name="Name_Section_Ar" class="form-control"
                                placeholder="{{ trans('dashboard.Section_name_ar') }}">
                        </div>

                        <div class="col">
                            <input type="text" name="Name_Section_En" class="form-control"
                                placeholder="{{ trans('dashboard.Section_name_en') }}">
                        </div>

                    </div>
                    <br>


                    <div class="col">
                        <label for="inputName" class="control-label">{{ trans('dashboard.Name_Grade') }}</label>
                        <select name="Grade_id" class="custom-select" onchange="console.log($(this).val())">
                            <!--placeholder-->
                            <option value="" selected disabled>{{ trans('dashboard.Select_Grade') }}
                            </option>
                            @foreach ($list_Grades as $list_Grade)
                            <option value="{{ $list_Grade->id }}"> {{ $list_Grade->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <br>

                    <div class="col">
                        <label for="inputName" class="control-label">{{ trans('dashboard.Name_Class') }}</label>
                        <select name="Class_id" class="custom-select">

                        </select>
                    </div> <br>

                    <div class="col">
                        <label for="inputName" class="control-label">{{
                            trans('dashboard.Name_Teacher')}}</label>
                        <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                            @foreach($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->Name}}</option>
                            @endforeach
                        </select>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('dashboard.Close')
                    }}</button>
                <button type="submit" class="btn btn-danger">{{ trans('dashboard.submit') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>