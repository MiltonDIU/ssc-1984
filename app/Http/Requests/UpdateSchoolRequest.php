<?php

namespace App\Http\Requests;

use App\Models\School;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSchoolRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('school_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'slug' => [
                'string',
                'nullable',
            ],
            'division_id' => [
                'required',
                'integer',
            ],
            'district_id' => [
                'required',
                'integer',
            ],
            'upazila_id' => [
                'required',
                'integer',
            ],
            'eiin' => [
                'string',
                'nullable',
            ],
            'post_office' => [
                'string',
                'nullable',
            ],
            'mobile' => [
                'string',
                'nullable',
            ],
            'management' => [
                'string',
                'nullable',
            ],
            'mpo' => [
                'string',
                'nullable',
            ],
            'is_active' => [
                'required',
            ],
        ];
    }
}
