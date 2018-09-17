<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Episode;
use App\Http\Requests\EpisodeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EpisodeController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $episodes = Episode::latest()->paginate(10);
        return view('admin.episodes.all' , compact('episodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::latest()->get();
        return view('admin.episodes.create' , compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EpisodeRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EpisodeRequest $request)
    {
        $episode = Episode::create($request->all());
        $this->setCourseTime($episode);

        return redirect(route('episodes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function show(Episode $episode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function edit(Episode $episode)
    {
        $courses = Course::latest()->get();
        return view('admin.episodes.edit' , compact('episode' , 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Episode $episode)
    {
        $episode->update($request->all());
        $this->setCourseTime($episode);
        return redirect(route('episodes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Episode $episode)
    {
        $episode->delete();
        return back();
    }
}
