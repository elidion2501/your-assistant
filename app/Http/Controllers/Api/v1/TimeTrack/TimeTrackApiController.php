<?php

namespace App\Http\Controllers\Api\v1\TimeTrack;

use App\Http\Controllers\Controller;
use App\Http\Requests\TimeTrack\TimeTrackStoreRequest;
use App\Http\Requests\TimeTrack\TimeTrackUpdateRequest;
use App\Models\TimeTrack\TimeTrack;
use App\Repositories\TimeTrack\TimeTrackRepository;
use App\Services\MainService;
use Illuminate\Http\Request;

class TimeTrackApiController extends Controller
{
    protected $timeTrackRepository;
    protected $perPage = 4;
    protected $orderBy = 'created_at';
    protected $ordering = 'ASC';


    public function __construct()
    {
        $this->timeTrackRepository = new TimeTrackRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timeTracks = $this->timeTrackRepository->getTimeTracksWithPaginate(
            auth()->user()->id,
            $this->perPage,
            $this->orderBy,
            $this->ordering
        );

        return response()->success($timeTracks);
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
    public function store(TimeTrackStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $timeTrack = TimeTrack::create($data);
        return response()->success($timeTrack);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $timeTrack = TimeTrack::where('slug', $slug)
        ->where('user_id', auth()->user()->id)
        ->firstOrFail();

        return response()->success($timeTrack);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(TimeTrackUpdateRequest $request, $slug)
    {
        $data = $request->validated();
        $timeTrack = TimeTrack::where('slug', $slug)->first();
        $timeTrack->update($data);
        return response()->success($timeTrack);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
    }

    function checkRequest($request)
    {
        ($request->perPage == null) ?: ($this->perPage = $request->perPage);
        ($request->orderBy == null) ?:  $this->orderBy = $request->orderBy;
        ($request->ordering == null) ?: ($this->ordering = $request->ordering);
    }
}
