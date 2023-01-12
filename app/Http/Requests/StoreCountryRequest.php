<?php

namespace App\Http\Requests;

use App\Models\Country;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCountryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('country_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:100',
                'required',
            ],
            'iso3' => [
                'string',
                'nullable',
            ],
            'numeric_code' => [
                'string',
                'nullable',
            ],
            'iso2' => [
                'string',
                'nullable',
            ],
            'phonecode' => [
                'string',
                'nullable',
            ],
            'capital' => [
                'string',
                'nullable',
            ],
            'currency' => [
                'string',
                'nullable',
            ],
            'currency_name' => [
                'string',
                'nullable',
            ],
            'currency_symbol' => [
                'string',
                'nullable',
            ],
            'tld' => [
                'string',
                'nullable',
            ],
            'native' => [
                'string',
                'nullable',
            ],
            'region' => [
                'string',
                'nullable',
            ],
            'subregion' => [
                'string',
                'nullable',
            ],
            'timezones' => [
                'string',
                'nullable',
            ],
            'translations' => [
                'string',
                'nullable',
            ],
            'latitude' => [
                'numeric',
            ],
            'longitude' => [
                'numeric',
            ],
            'emoji' => [
                'string',
                'nullable',
            ],
            'emoji_u' => [
                'string',
                'nullable',
            ],
            'wiki_data' => [
                'string',
                'nullable',
            ],
            'flag' => [
                'required',
            ],
            'is_active' => [
                'required',
            ],
        ];
    }
}
