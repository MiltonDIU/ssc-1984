<?php

namespace App\Http\Requests;

use App\Models\Spouse;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSpouseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('spouse_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'event_id' => [
                'required',
                'integer',
            ],
            'created_by' => [
                'string',
                'nullable',
            ],
            'avatar' => [
                'required',
            ],
        ];
    }
}
