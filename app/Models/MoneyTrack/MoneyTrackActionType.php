<?php

namespace App\Models\MoneyTrack;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MoneyTrackActionType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'type_name',
    ];

    //Money tracks that have some action type
    public function moneyTracks()
    {
        return $this->hasMany(MoneyTrack::class);
    }
}
