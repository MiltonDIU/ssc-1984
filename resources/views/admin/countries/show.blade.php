@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.country.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.countries.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.id') }}
                        </th>
                        <td>
                            {{ $country->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.name') }}
                        </th>
                        <td>
                            {{ $country->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.iso3') }}
                        </th>
                        <td>
                            {{ $country->iso3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.numeric_code') }}
                        </th>
                        <td>
                            {{ $country->numeric_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.iso2') }}
                        </th>
                        <td>
                            {{ $country->iso2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.phonecode') }}
                        </th>
                        <td>
                            {{ $country->phonecode }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.capital') }}
                        </th>
                        <td>
                            {{ $country->capital }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.currency') }}
                        </th>
                        <td>
                            {{ $country->currency }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.currency_name') }}
                        </th>
                        <td>
                            {{ $country->currency_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.currency_symbol') }}
                        </th>
                        <td>
                            {{ $country->currency_symbol }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.tld') }}
                        </th>
                        <td>
                            {{ $country->tld }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.native') }}
                        </th>
                        <td>
                            {{ $country->native }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.region') }}
                        </th>
                        <td>
                            {{ $country->region }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.subregion') }}
                        </th>
                        <td>
                            {{ $country->subregion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.timezones') }}
                        </th>
                        <td>
                            {{ $country->timezones }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.translations') }}
                        </th>
                        <td>
                            {{ $country->translations }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.latitude') }}
                        </th>
                        <td>
                            {{ $country->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.longitude') }}
                        </th>
                        <td>
                            {{ $country->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.emoji') }}
                        </th>
                        <td>
                            {{ $country->emoji }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.emoji_u') }}
                        </th>
                        <td>
                            {{ $country->emoji_u }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.wiki_data') }}
                        </th>
                        <td>
                            {{ $country->wiki_data }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.flag') }}
                        </th>
                        <td>
                            {{ App\Models\Country::FLAG_SELECT[$country->flag] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.country.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Country::IS_ACTIVE_SELECT[$country->is_active] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.countries.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('global.relatedData') }}
        </div>
        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
            <li class="nav-item">
                <a class="nav-link" href="#country_states" role="tab" data-toggle="tab">
                    {{ trans('cruds.state.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="country_states">
                @includeIf('admin.countries.relationships.countryStates', ['states' => $country->countryStates])
            </div>
        </div>
    </div>

@endsection
