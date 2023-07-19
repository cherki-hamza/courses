<div class="modal fade" id="edit{{ $list_section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                    {{ trans('dashboard.edit_Section') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('sections.update', 'test') }}" method="POST">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col">
                            <input type="text" name="Name_Section_Ar" class="form-control"
                                value="{{ $list_section->getTranslation('section_name', 'ar') }}">
                        </div>

                        <div class="col">
                            <input type="text" name="Name_Section_En" class="form-control"
                                value="{{ $list_section->getTranslation('section_name', 'en') }}">

                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $list_section->id }}">
                        </div>

                    </div>
                    <br>


                    <div class="col">
                        <label for="inputName" class="control-label">{{
                            trans('dashboard.Name_Grade')
                            }}</label>
                        <select name="Grade_id" class="custom-select" onclick="console.log($(this).val())">
                            <!--placeholder-->
                            <option value="{{ $Grade->id }}">
                                {{ $Grade->name }}
                            </option>
                            @foreach ($list_Grades as
                            $list_Grade)
                            <option value="{{ $list_Grade->id }}">
                                {{ $list_Grade->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <br>

                    <div class="col">
                        <label for="inputName" class="control-label">{{
                            trans('dashboard.Name_Class')
                            }}</label>
                        <select name="Class_id" class="custom-select">
                            <option value="{{ $list_section->classroom->id }}">
                                {{
                                $list_section->classroom->Name_Class
                                }}
                            </option>
                        </select>
                    </div>
                    <br>

                    <div class="col">
                        <label for="inputName" class="control-label">{{trans('dashboard.Name_Teacher')}}</label>
                        <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                            @foreach($list_section->teachers as $teacher)
                            <option selected value="{{$teacher->id}}">{{$teacher->Name}}</option>
                            @endforeach
                            <option style="height: 5px;color: red;width: auto">
                                -------------------------------------------------------</option>
                            @foreach($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->Name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <br>

                    <div class="col">
                        <div class="form-check">

                            @if($list_section->section_status
                            === 1)
                            <input type="checkbox" checked class="form-check-input" name="Status" id="exampleCheck1">
                            @else
                            <input type="checkbox" class="form-check-input" name="Status" id="exampleCheck1">
                            @endif
                            <label class="form-check-label" for="exampleCheck1">{{
                                trans('dashboard.Status')
                                }}</label>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{
                    trans('dashboard.Close') }}</button>
                <button type="submit" class="btn btn-danger">{{
                    trans('dashboard.submit') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>