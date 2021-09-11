<?php

namespace App\Models\TimeTrack;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeTrackType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'type_name',
        'slug',
    ];

}
