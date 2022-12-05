<?php

namespace App\Http\Requests;

use App\Models\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEventRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_create');
    }

    public function rules()
    {
        return [
            'event_category_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'slug' => [
                'string',
                'required',
                'unique:events',
            ],
            'banner' => [
                'required',
            ],
            'details' => [
                'required',
            ],
            'event_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'event_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'event_end_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'district_id' => [
                'required',
                'integer',
            ],
            'price' => [
                'string',
                'nullable',
            ],
            'users.*' => [
                'integer',
            ],
            'users' => [
                'array',
            ],
            'is_active' => [
                'required',
            ],
        ];
    }
}
