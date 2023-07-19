<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    //  composer dumpautoload

    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $teacher)
    {
        $this->Teacher = $teacher;
    }

    public function index()
    {
        return $this->Teacher->getAllTeachers();
        //return view('backend.teachers.index_teacher');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
