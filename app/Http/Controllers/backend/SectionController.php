<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::with('sections')->get();
        $teachers = Teacher::all();

        //dd($grades->sections);
        $list_Grades = Grade::all();

        return view('backend.section.index_section', compact('list_Grades', 'grades', 'teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSectionRequest $request)
    {

        try {

            $validated = $request->validated();
            $section = new Section();

            $section->section_name = [
                'ar' => $request->Name_Section_Ar,
                'en' => $request->Name_Section_En
            ];
            $section->Grade_id = $request->Grade_id;
            $section->classroom_id = $request->Class_id;
            $section->section_status = 1;
            $section->save();

            // atach relationship between section and teacher
            $section->Teachers()->attach($request->teacher_id);

            flash()->addSuccess(trans('dashboard.success'));

            return back();
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSectionRequest $request, $id)
    {
        $status = 1;
        if ($request->Status !== 'on') {
            $status = 2;
        }
        try {
            $validated = $request->validated();
            $section = Section::findOrFail($request->id);

            $section->update([
                'section_name' => [
                    'ar' => $request->get('Name_Section_Ar'),
                    'en' => $request->get('Name_Section_En'),
                ],
                'section_status' => $status,
                'Grade_id' => $request->Grade_id,
                'classroom_id' => $request->Class_id,
            ]);

            // update pivot Table Teacher_Section
            if (isset($request->teacher_id)) {
                $section->Teachers()->sync($request->teacher_id);
            } else {
                $section->Teachers()->sync(array());
            }



            flash()->addSuccess(trans('dashboard.Update'));

            return back();
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Section::findOrFail($request->id)->delete();
        flash()->addError(trans('messages.Delete'));
        return back();
    }

    // method for get the classes by ajax request
    public function get_classes($id)
    {
        $list_classes = Classroom::where('grade_id', $id)->pluck('Name_Class', 'id');
        return $list_classes;
    }
}
