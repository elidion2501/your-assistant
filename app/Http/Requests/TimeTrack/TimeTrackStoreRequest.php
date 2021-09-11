<?php

namespace App\Http\Requests\TimeTrack;

use Illuminate\Foundation\Http\FormRequest;

class TimeTrackStoreRequest extends FormRequest
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
            'time_from' => 'required|date|date_format:Y-m-d H:i:s',
            'time_to' => 'required|date|date_format:Y-m-d H:i:s|after:time_from',
            'time_track_type_id' => 'required|exists:time_track_types,id'
        ];
    }
}
