<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\TimeTrack\TimeTrack;
use Illuminate\Http\Request;

class TimeTrackApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimeTrack  $timeTrack
     * @return \Illuminate\Http\Response
     */
    public function show(TimeTrack $timeTrack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TimeTrack  $timeTrack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimeTrack $timeTrack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeTrack  $timeTrack
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeTrack $timeTrack)
    {
        //
    }
}
