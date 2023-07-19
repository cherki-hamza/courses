<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassRoomRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::all();
        $List_Classes = Classroom::with('Grades')->get();

        return view('backend.class.index_class', compact('grades', 'List_Classes'));
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
    public function store(StoreClassRoomRequest $request)
    {

        $list_classes = $request->List_Classes;

        try {

            /* $request->validate([
                'List_Classes.*.name_class_ar' => 'required',
                'List_Classes.*.name_class_en' => 'required',
                //'grade_id' => 'required',
            ], [
                'List_Classes.*.name_class_ar.required' => 'The Arabic name class is required',
                'List_Classes.*.name_class_en.required' => 'The English name class is required',
                //'grade_id.required' => 'The grade is required',
            ]); */

            foreach ($list_classes as $list_class) {

                $class_room = new Classroom();

                $class_room->Name_Class    = [
                    'ar' => $list_class['name_class_ar'],
                    'en' => $list_class['name_class_en'],
                ];

                $class_room->grade_id = $list_class['grade_id'];

                $class_room->save();
            }

            flash()->addSuccess('The Class Insert with success');

            return back();
        } catch (\Exception $e) {
            return back()->withErrors(['errors' => $e->getMessage()]);
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
            $class_room = Classroom::findOrFail($request->class_room_id);
            $class_room->update([
                'Name_Class' => [
                    'ar' => $request->get('name_class_ar'),
                    'en' => $request->get('name_class_en'),
                ],
                'grade_id' => $request->get('grade_id'),
            ]);

            flash()->addSuccess("The ClassRoom {$class_room->Name_Class} updated with success");

            return back();
        } catch (\Exception $e) {
            return back()->withErrors(['errors' => $e->getMessage()]);
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

            $class_room = Classroom::findOrFail($request->class_room_id);
            $class_room->delete();
            flash()->addSuccess("The ClassRoom  Deleted with success");

            return back();
        } catch (\Exception $e) {
            return back()->withErrors(['errors' => $e->getMessage()]);
        }
    }


    // methode for delete all checkboxes for all alassRoomses
    public function delete_all(Request $request)
    {
        $select_all_ids = explode(',', $request->delete_all_id);
        Classroom::whereIn('id', $select_all_ids)->delete();
        flash()->addSuccess("The Selected ClassRoom (s)  Deleted with success");

        return back();
    }


    // method for fillter classroom By Grade
    public function Filter_Classes(Request $request)
    {
        $grades = Grade::all();

        $grade_name = Grade::select('name')->where('id', $request->grade_id)->first('name');

        $searsh = Classroom::where('grade_id', $request->grade_id)->get();

        if (request()->route()->getName() === 'Filter_Classes') {

            flash()->addInfo("The ClassRoom Filter Result Fillter with <strong>🔥  $grade_name->name  🔥 </strong> ");
        }


        return view('backend.class.index_class', compact('grades', 'grade_name'))->withDetails($searsh);
    }
}
