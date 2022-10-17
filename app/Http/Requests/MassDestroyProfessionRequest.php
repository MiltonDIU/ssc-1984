<?php

namespace App\Http\Requests;

use App\Models\Profession;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProfessionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('profession_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:professions,id',
        ];
    }
}
