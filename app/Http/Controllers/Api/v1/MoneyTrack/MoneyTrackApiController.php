<?php

namespace App\Http\Controllers\Api\v1\MoneyTrack;

use App\Http\Controllers\Controller;
use App\Http\Resources\MoneyTrack\MoneyTrackCollection;
use App\Http\Resources\MoneyTrack\MoneyTrackShowResource;
use App\Models\MoneyTrack\MoneyTrack;
use App\Repositories\MoneyTrack\MoneyTrackRepository;
use Illuminate\Http\Request;

/**
 * 
 * @group Time Tracks
 * 
 * @authenticated
 * 
 */
class MoneyTrackApiController extends Controller
{

    protected $moneyTrackRepository;
    protected $perPage = 15;
    protected $orderBy = 'created_at';
    protected $ordering = 'ASC';


    public function __construct()
    {
        $this->moneyTrackRepository = new MoneyTrackRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkRequest($request);

        $timeTracks = $this->moneyTrackRepository->getMoneyTracksWithPaginate(
            auth()->user()->id,
            $this->perPage,
            $this->orderBy,
            $this->ordering
        );

        return response()->success(new MoneyTrackCollection($timeTracks));
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
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $moneyTrack = MoneyTrack::where('slug', $slug)
            ->where('user_id', auth()->user()->id)
            ->with([
                'user:id,slug,nickname',
                'moneyTrackType:id,type_name,slug',
                'moneyTrackActionType:id,type_name,slug',
            ])
            ->firstOrFail();

        return response()->success(new MoneyTrackShowResource($moneyTrack));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //
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
