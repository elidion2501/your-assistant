<?php

namespace App\Http\Controllers\Api\v1\TimeTrack;

use App\Http\Controllers\Controller;
use App\Http\Resources\TimeTrackType\TimeTrackTypeCollection;
use App\Models\TimeTrack\TimeTrackType;
use Illuminate\Http\Request;

/**
 * 
 * @group Time Tracks
 * 
 * @authenticated
 * 
 */
class TimeTrackTypeApiController extends Controller
{
    /**
     * GET Time Track Types
     */
    public function index()
    {
        $timeTrackTypes = TimeTrackType::all();

        return response()->success(new TimeTrackTypeCollection($timeTrackTypes));
    }
}
