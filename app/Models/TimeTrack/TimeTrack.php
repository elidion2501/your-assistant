<?php

namespace App\Models\TimeTrack;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTrack extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'description',
        'slug',
        'time_from',
        'time_to',
    ];

    public function timeTrackType()
    {
        return $this->belongsTo(TimeTrackType::class);
    }

    //user that created time track
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
