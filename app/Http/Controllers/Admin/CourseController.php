<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //7
        $courses = Course::paginate(10);
        return view('admin.courses.all' , compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourseRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        //auth()->loginUsingId(1);

        //return Auth::user();

        $file = $request->file('images');

        $imageUrl = $this->uploadImage($file);
        auth()->user()->courses()->create(array_merge($request->all() , ['images'=>$imageUrl]));

        return redirect(route('courses.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('admin.courses.edit' , compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CourseRequest|Request $request
     * @param  \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, Course $course)
    {
        $file = $request->file('images');
        $inputs = $request->all();
        if ($file)
        {
            $inputs['images'] = $this->uploadImage($file);
        }else
        {
            $inputs['images'] = $course->images;
            $inputs['images']['thumb'] = $inputs['thumb'];
        }

        unset($inputs['thumb']);
        $course->update($inputs);

        return redirect(route('courses.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect(route('courses.all'));
    }
}
