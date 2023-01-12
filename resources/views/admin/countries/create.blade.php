@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.country.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.countries.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.country.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="iso3">{{ trans('cruds.country.fields.iso3') }}</label>
                    <input class="form-control {{ $errors->has('iso3') ? 'is-invalid' : '' }}" type="text" name="iso3" id="iso3" value="{{ old('iso3', '') }}">
                    @if($errors->has('iso3'))
                        <div class="invalid-feedback">
                            {{ $errors->first('iso3') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.iso3_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="numeric_code">{{ trans('cruds.country.fields.numeric_code') }}</label>
                    <input class="form-control {{ $errors->has('numeric_code') ? 'is-invalid' : '' }}" type="text" name="numeric_code" id="numeric_code" value="{{ old('numeric_code', '') }}">
                    @if($errors->has('numeric_code'))
                        <div class="invalid-feedback">
                            {{ $errors->first('numeric_code') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.numeric_code_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="iso2">{{ trans('cruds.country.fields.iso2') }}</label>
                    <input class="form-control {{ $errors->has('iso2') ? 'is-invalid' : '' }}" type="text" name="iso2" id="iso2" value="{{ old('iso2', '') }}">
                    @if($errors->has('iso2'))
                        <div class="invalid-feedback">
                            {{ $errors->first('iso2') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.iso2_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="phonecode">{{ trans('cruds.country.fields.phonecode') }}</label>
                    <input class="form-control {{ $errors->has('phonecode') ? 'is-invalid' : '' }}" type="text" name="phonecode" id="phonecode" value="{{ old('phonecode', '') }}">
                    @if($errors->has('phonecode'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phonecode') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.phonecode_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="capital">{{ trans('cruds.country.fields.capital') }}</label>
                    <input class="form-control {{ $errors->has('capital') ? 'is-invalid' : '' }}" type="text" name="capital" id="capital" value="{{ old('capital', '') }}">
                    @if($errors->has('capital'))
                        <div class="invalid-feedback">
                            {{ $errors->first('capital') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.capital_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="currency">{{ trans('cruds.country.fields.currency') }}</label>
                    <input class="form-control {{ $errors->has('currency') ? 'is-invalid' : '' }}" type="text" name="currency" id="currency" value="{{ old('currency', '') }}">
                    @if($errors->has('currency'))
                        <div class="invalid-feedback">
                            {{ $errors->first('currency') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.currency_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="currency_name">{{ trans('cruds.country.fields.currency_name') }}</label>
                    <input class="form-control {{ $errors->has('currency_name') ? 'is-invalid' : '' }}" type="text" name="currency_name" id="currency_name" value="{{ old('currency_name', '') }}">
                    @if($errors->has('currency_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('currency_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.currency_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="currency_symbol">{{ trans('cruds.country.fields.currency_symbol') }}</label>
                    <input class="form-control {{ $errors->has('currency_symbol') ? 'is-invalid' : '' }}" type="text" name="currency_symbol" id="currency_symbol" value="{{ old('currency_symbol', '') }}">
                    @if($errors->has('currency_symbol'))
                        <div class="invalid-feedback">
                            {{ $errors->first('currency_symbol') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.currency_symbol_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="tld">{{ trans('cruds.country.fields.tld') }}</label>
                    <input class="form-control {{ $errors->has('tld') ? 'is-invalid' : '' }}" type="text" name="tld" id="tld" value="{{ old('tld', '') }}">
                    @if($errors->has('tld'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tld') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.tld_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="native">{{ trans('cruds.country.fields.native') }}</label>
                    <input class="form-control {{ $errors->has('native') ? 'is-invalid' : '' }}" type="text" name="native" id="native" value="{{ old('native', '') }}">
                    @if($errors->has('native'))
                        <div class="invalid-feedback">
                            {{ $errors->first('native') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.native_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="region">{{ trans('cruds.country.fields.region') }}</label>
                    <input class="form-control {{ $errors->has('region') ? 'is-invalid' : '' }}" type="text" name="region" id="region" value="{{ old('region', '') }}">
                    @if($errors->has('region'))
                        <div class="invalid-feedback">
                            {{ $errors->first('region') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.region_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="subregion">{{ trans('cruds.country.fields.subregion') }}</label>
                    <input class="form-control {{ $errors->has('subregion') ? 'is-invalid' : '' }}" type="text" name="subregion" id="subregion" value="{{ old('subregion', '') }}">
                    @if($errors->has('subregion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('subregion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.subregion_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="timezones">{{ trans('cruds.country.fields.timezones') }}</label>
                    <input class="form-control {{ $errors->has('timezones') ? 'is-invalid' : '' }}" type="text" name="timezones" id="timezones" value="{{ old('timezones', '') }}">
                    @if($errors->has('timezones'))
                        <div class="invalid-feedback">
                            {{ $errors->first('timezones') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.timezones_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="translations">{{ trans('cruds.country.fields.translations') }}</label>
                    <input class="form-control {{ $errors->has('translations') ? 'is-invalid' : '' }}" type="text" name="translations" id="translations" value="{{ old('translations', '') }}">
                    @if($errors->has('translations'))
                        <div class="invalid-feedback">
                            {{ $errors->first('translations') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.translations_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="latitude">{{ trans('cruds.country.fields.latitude') }}</label>
                    <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="number" name="latitude" id="latitude" value="{{ old('latitude', '') }}" step="0.00000001">
                    @if($errors->has('latitude'))
                        <div class="invalid-feedback">
                            {{ $errors->first('latitude') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.latitude_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="longitude">{{ trans('cruds.country.fields.longitude') }}</label>
                    <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="number" name="longitude" id="longitude" value="{{ old('longitude', '') }}" step="0.00000001">
                    @if($errors->has('longitude'))
                        <div class="invalid-feedback">
                            {{ $errors->first('longitude') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.longitude_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="emoji">{{ trans('cruds.country.fields.emoji') }}</label>
                    <input class="form-control {{ $errors->has('emoji') ? 'is-invalid' : '' }}" type="text" name="emoji" id="emoji" value="{{ old('emoji', '') }}">
                    @if($errors->has('emoji'))
                        <div class="invalid-feedback">
                            {{ $errors->first('emoji') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.emoji_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="emoji_u">{{ trans('cruds.country.fields.emoji_u') }}</label>
                    <input class="form-control {{ $errors->has('emoji_u') ? 'is-invalid' : '' }}" type="text" name="emoji_u" id="emoji_u" value="{{ old('emoji_u', '') }}">
                    @if($errors->has('emoji_u'))
                        <div class="invalid-feedback">
                            {{ $errors->first('emoji_u') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.emoji_u_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="wiki_data">{{ trans('cruds.country.fields.wiki_data') }}</label>
                    <input class="form-control {{ $errors->has('wiki_data') ? 'is-invalid' : '' }}" type="text" name="wiki_data" id="wiki_data" value="{{ old('wiki_data', '') }}">
                    @if($errors->has('wiki_data'))
                        <div class="invalid-feedback">
                            {{ $errors->first('wiki_data') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.wiki_data_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.country.fields.flag') }}</label>
                    <select class="form-control {{ $errors->has('flag') ? 'is-invalid' : '' }}" name="flag" id="flag" required>
                        <option value disabled {{ old('flag', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Country::FLAG_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('flag', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('flag'))
                        <div class="invalid-feedback">
                            {{ $errors->first('flag') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.flag_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.country.fields.is_active') }}</label>
                    <select class="form-control {{ $errors->has('is_active') ? 'is-invalid' : '' }}" name="is_active" id="is_active" required>
                        <option value disabled {{ old('is_active', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Country::IS_ACTIVE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('is_active', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('is_active'))
                        <div class="invalid-feedback">
                            {{ $errors->first('is_active') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.country.fields.is_active_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection
