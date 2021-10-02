<?php

namespace App\Http\Requests\TimeTrack;

use App\Models\TimeTrack\TimeTrack;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class TimeTrackUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'nullable|string|min:5|max:1500',
            'time_from' => 'nullable|required_with:time_to|date|date_format:Y-m-d H:i:s',
            'time_to' => 'nullable|required_with:time_from|date|date_format:Y-m-d H:i:s|after:time_from',
            'time_track_type_id' => 'nullable|integer|exists:time_track_types,id'
        ];
    }
    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        if (count($validator->errors()->messages()) == 0) {
            $validator->after(function ($validator) {
                if (!DB::table('time_tracks')->where('slug', $this->slug)->where('user_id', auth()->user()->id)->select('id')->first()) {
                    abort(403);
                }

                if (DB::table('time_tracks')
                    ->where('user_id', auth()->user()->id)
                    ->where('time_to', '>', $this->time_from)
                    ->where('time_from', '<', $this->time_from)
                    ->where('slug', '!=', $this->slug)
                    ->select('id')
                    ->first()
                ) {
                    $validator->errors()->add('time_from', 'Time already taken.');
                }
                if (DB::table('time_tracks')
                    ->where('user_id', auth()->user()->id)
                    ->where('time_to', '>', $this->time_to)
                    ->where('time_from', '<', $this->time_to)
                    ->where('slug', '!=', $this->slug)
                    ->select('id')
                    ->first()
                ) {
                    $validator->errors()->add('time_to', 'Time already taken.');
                }
            });
        }
        return;
    }
}
