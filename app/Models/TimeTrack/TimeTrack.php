<?php

namespace App\Models\TimeTrack;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'time_track_type_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'time_from' => 'datetime',
        'time_to' => 'datetime',
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
