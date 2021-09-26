<?php

namespace App\Http\Controllers\Api\v1\TimeTrack;

use App\Http\Controllers\Controller;
use App\Http\Requests\TimeTrack\TimeTrackStoreRequest;
use App\Http\Requests\TimeTrack\TimeTrackUpdateRequest;
use App\Http\Resources\TimeTrack\TimeTrackCollection;
use App\Http\Resources\TimeTrack\TimeTrackShowResource;
use App\Models\TimeTrack\TimeTrack;
use App\Repositories\TimeTrack\TimeTrackRepository;
use App\Services\MainService;
use Illuminate\Http\Request;

/**
 * 
 * @group Time Tracks
 * @tag slug="2021-08-25-191919"
 * 
 * @authenticated
 * 
 */

class TimeTrackApiController extends Controller
{
    protected $timeTrackRepository;
    protected $perPage = 15;
    protected $orderBy = 'time_from';
    protected $ordering = 'ASC';


    public function __construct()
    {
        $this->timeTrackRepository = new TimeTrackRepository;
    }

    /**
     * GET Time Tracks
     * 
     * Get Time Tracks list with pagination
     * 
     * @bodyParam  perPage integer  Items per page. Example:1
     * @bodyParam  orderBy string  Order by which field. Example:time_from
     * @bodyParam  ordering string  ORder ASC or DESC. Example:DESC
     */

    public function index(Request $request)
    {
        $this->checkRequest($request);

        $timeTracks = $this->timeTrackRepository->getTimeTracksWithPaginate(
            auth()->user()->id,
            $this->perPage,
            $this->orderBy,
            $this->ordering
        );

        return response()->success(new TimeTrackCollection($timeTracks));
    }

    /**
     *POST create Time Track 
     *
     * Store a newly created resource in storage.
     * 
     * @bodyParam  time_from date required Time from Example: 2021-09-25 15:10:38
     * @bodyParam  time_to date required Time to. Example: 2021-10-25 15:10:38
     * @bodyParam  time_track_type_id integer required ID type of TIme Track. Example: 3
     * 
     * 
     */
    public function store(TimeTrackStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $timeTrack = TimeTrack::create($data);
        return response()->success(new TimeTrackShowResource($timeTrack->load(['user:id,slug,nickname', 'timeTrackType:id,type_name,slug'])));
    }

    /**
     * GET show Time Track
     * 
     * 
     * @urlParam slug string  required The ID of the post. Example:2333
     */
    public function show($slug)
    {
        $timeTrack = TimeTrack::where('slug', $slug)
            ->where('user_id', auth()->user()->id)
            ->with(['user:id,slug,nickname', 'timeTrackType:id,type_name,slug'])
            ->firstOrFail();

        return response()->success(new TimeTrackShowResource($timeTrack));
    }

    /**
     * PUT/PATCH update Time Track
     * 
     * @urlParam slug string  required The ID of the post. Example:2333
     * @bodyParam  time_from date required Time from Example: 2019-09-25 15:10:38
     * @bodyParam  time_to date required Time to. Example: 2019-10-25 15:10:38
     * 
     */
    public function update(TimeTrackUpdateRequest $request, $slug)
    {
        $data = $request->validated();
        $timeTrack = TimeTrack::where('slug', $slug)->firstOrFail();
        $timeTrack->update($data);
        return response()->success(new TimeTrackShowResource($timeTrack->load(['user:id,slug,nickname', 'timeTrackType:id,type_name,slug'])));
    }

    /**
     * DELETE delete TimeTrack
     * 
     * 
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
