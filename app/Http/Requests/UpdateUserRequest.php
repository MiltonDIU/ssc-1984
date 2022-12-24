<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users,email,' . request()->route('user')->id,
            ],
            'mobile' => [
                'required',
                'unique:users,mobile,' . request()->route('user')->id,
            ],
            'telephone_number' => [
                'string',
                'nullable',
            ],
            'gender' => [
                'required',
            ],
            'date_of_birth' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'blood_group' => [
                'string',
                'nullable',
            ],
            'school_id' => [
                'required',
                'integer',
            ],
            'professions.*' => [
                'integer',
            ],
            'professions' => [
                'required',
                'array',
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
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
            'id_ssc_bd' => [
                'string',
                'nullable',
            ],
            'id_ssc_district' => [
                'string',
                'nullable',
            ],
        ];
    }
}
