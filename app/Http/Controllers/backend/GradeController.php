<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //flash()->addSuccess('Your payment has been accepted 2023 .');

        $gardes = Grade::all();
        return view('backend.grades.index_grade', ['gardes' => $gardes]);
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
    public function store(StoreGradeRequest $request)
    {

        if (Grade::where('name->ar', $request->name_ar)->orWhere('name->en', $request->name_en)->orWhere('name->fr', $request->name_fr)->exists()) {
            return back()->withErrors(trans('dashboard.exists'));
        }

        try {

            /* $request->validate([
                'name_ar' => 'required',
                'name_en' => 'required',
            ], [
                'name_ar.required' => 'Le nom en Arab il est nécessaire',
                'name_en.required' => 'Le nom en Englais il est nécessaire',
            ]); */

            Grade::create([
                'name' => [
                    'ar' => $request->get('name_ar'),
                    'en' => $request->get('name_en'),
                    'fr' => $request->get('name_fr'),
                ],
                'notes' => [
                    'ar' => $request->get('note_ar'),
                    'en' => $request->get('note_en'),
                    'fr' => $request->get('note_fr'),
                ]
            ]);

            flash()->addSuccess('The Grade Insert with success');

            return back();
        } catch (\Exception $e) {

            return back()->withErrors(['error' => $e->getMessage(), 'stack' => $e->getTraceAsString()]);
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
    public function update(Request $request)
    {

        try {
            $grade = Grade::findOrFail($request->id);
            $request->validate([
                'name_ar' => 'required',
                'name_en' => 'required',
            ], [
                'name_ar.required' => 'Le nom en Arab il est nécessaire',
                'name_en.required' => 'Le nom en Englai il est nécessaire',
            ]);

            $grade->update([
                'name' => [
                    'ar' => $request->get('name_ar'),
                    'en' => $request->get('name_en'),
                    'fr' => $request->get('name_fr'),
                ],
                'notes' => [
                    'ar' => $request->get('note_ar'),
                    'en' => $request->get('note_en'),
                    'fr' => $request->get('note_fr'),
                ]
            ]);

            flash()->addSuccess('The Grade updated with success');

            return back();
        } catch (\Exception  $e) {
            return back()->withErrors(['error' => $e->getMessage(), 'stack' => $e->getTraceAsString()]);
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
        try {
            $class_with_grade = Classroom::where('grade_id', $request->grade_id)->pluck('grade_id');

            if ($class_with_grade->count() == 0) {

                $grade = Grade::findOrFail($request->grade_id);
                $grade->delete();
                flash()->addSuccess('The Grade deleted with success');
                return back();
            } else {
                notyf()
                    ->position('x', 'center')
                    ->position('y', 'top')
                    ->addError(trans('dashboard.delete_Grade_Error'));

                return back();
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage(), 'stack' => $e->getTraceAsString()]);
        }
    }
}
