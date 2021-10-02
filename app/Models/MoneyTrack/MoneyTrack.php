<?php

namespace App\Models\MoneyTrack;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class MoneyTrack extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'description',
        'title',
        'slug',
        'money_track_type_id',
        'money_track_action_type_id',
        'money'
    ];

    public function moneyTrackType()
    {
        return $this->belongsTo(MoneyTrackType::class);
    }

    public function moneyTrackActionType()
    {
        return $this->belongsTo(MoneyTrackActionType::class);
    }

    //user that created money track
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
