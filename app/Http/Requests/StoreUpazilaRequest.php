<?php

namespace App\Http\Requests;

use App\Models\Upazila;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUpazilaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('upazila_create');
    }

    public function rules()
    {
        return [
            'district_id' => [
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
            ],
            'bn_name' => [
                'string',
                'nullable',
            ],
            'url' => [
                'string',
                'nullable',
            ],
            'is_active' => [
                'required',
            ],
        ];
    }
}
