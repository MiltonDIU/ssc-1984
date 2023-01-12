@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.city.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.cities.update", [$city->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.city.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $city->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.city.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="country_id">{{ trans('cruds.city.fields.country') }}</label>
                    <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id" required>
                        @foreach($countries as $id => $entry)
                            <option value="{{ $id }}" {{ (old('country_id') ? old('country_id') : $city->country->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('country'))
                        <div class="invalid-feedback">
                            {{ $errors->first('country') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.city.fields.country_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="state_id">{{ trans('cruds.city.fields.state') }}</label>
                    <select class="form-control select2 {{ $errors->has('state') ? 'is-invalid' : '' }}" name="state_id" id="state_id" required>
                        @foreach($states as $id => $entry)
                            <option value="{{ $id }}" {{ (old('state_id') ? old('state_id') : $city->state->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('state'))
                        <div class="invalid-feedback">
                            {{ $errors->first('state') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.city.fields.state_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="state_code">{{ trans('cruds.city.fields.state_code') }}</label>
                    <input class="form-control {{ $errors->has('state_code') ? 'is-invalid' : '' }}" type="text" name="state_code" id="state_code" value="{{ old('state_code', $city->state_code) }}">
                    @if($errors->has('state_code'))
                        <div class="invalid-feedback">
                            {{ $errors->first('state_code') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.city.fields.state_code_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.city.fields.flag') }}</label>
                    <select class="form-control {{ $errors->has('flag') ? 'is-invalid' : '' }}" name="flag" id="flag" required>
                        <option value disabled {{ old('flag', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\City::FLAG_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('flag', $city->flag) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('flag'))
                        <div class="invalid-feedback">
                            {{ $errors->first('flag') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.city.fields.flag_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.city.fields.is_active') }}</label>
                    <select class="form-control {{ $errors->has('is_active') ? 'is-invalid' : '' }}" name="is_active" id="is_active" required>
                        <option value disabled {{ old('is_active', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\City::IS_ACTIVE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('is_active', $city->is_active) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('is_active'))
                        <div class="invalid-feedback">
                            {{ $errors->first('is_active') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.city.fields.is_active_helper') }}</span>
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
