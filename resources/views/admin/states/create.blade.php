@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.state.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.states.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.state.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.state.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="country_id">{{ trans('cruds.state.fields.country') }}</label>
                    <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id" required>
                        @foreach($countries as $id => $entry)
                            <option value="{{ $id }}" {{ old('country_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('country'))
                        <div class="invalid-feedback">
                            {{ $errors->first('country') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.state.fields.country_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="country_code">{{ trans('cruds.state.fields.country_code') }}</label>
                    <input class="form-control {{ $errors->has('country_code') ? 'is-invalid' : '' }}" type="text" name="country_code" id="country_code" value="{{ old('country_code', '') }}">
                    @if($errors->has('country_code'))
                        <div class="invalid-feedback">
                            {{ $errors->first('country_code') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.state.fields.country_code_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.state.fields.flag') }}</label>
                    <select class="form-control {{ $errors->has('flag') ? 'is-invalid' : '' }}" name="flag" id="flag" required>
                        <option value disabled {{ old('flag', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\State::FLAG_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('flag', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('flag'))
                        <div class="invalid-feedback">
                            {{ $errors->first('flag') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.state.fields.flag_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.state.fields.is_active') }}</label>
                    <select class="form-control {{ $errors->has('is_active') ? 'is-invalid' : '' }}" name="is_active" id="is_active" required>
                        <option value disabled {{ old('is_active', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\State::IS_ACTIVE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('is_active', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('is_active'))
                        <div class="invalid-feedback">
                            {{ $errors->first('is_active') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.state.fields.is_active_helper') }}</span>
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
