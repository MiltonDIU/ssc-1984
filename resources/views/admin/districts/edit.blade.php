@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.district.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.districts.update", [$district->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="division_id">{{ trans('cruds.district.fields.division') }}</label>
                    <select class="form-control select2 {{ $errors->has('division') ? 'is-invalid' : '' }}" name="division_id" id="division_id" required>
                        @foreach($divisions as $id => $entry)
                            <option value="{{ $id }}" {{ (old('division_id') ? old('division_id') : $district->division->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('division'))
                        <div class="invalid-feedback">
                            {{ $errors->first('division') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.district.fields.division_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.district.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $district->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.district.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="slug">{{ trans('cruds.district.fields.slug') }}</label>
                    <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $district->slug) }}" required>
                    @if($errors->has('slug'))
                        <div class="invalid-feedback">
                            {{ $errors->first('slug') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.district.fields.slug_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="bn_name">{{ trans('cruds.district.fields.bn_name') }}</label>
                    <input class="form-control {{ $errors->has('bn_name') ? 'is-invalid' : '' }}" type="text" name="bn_name" id="bn_name" value="{{ old('bn_name', $district->bn_name) }}">
                    @if($errors->has('bn_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('bn_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.district.fields.bn_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="lat">{{ trans('cruds.district.fields.lat') }}</label>
                    <input class="form-control {{ $errors->has('lat') ? 'is-invalid' : '' }}" type="text" name="lat" id="lat" value="{{ old('lat', $district->lat) }}">
                    @if($errors->has('lat'))
                        <div class="invalid-feedback">
                            {{ $errors->first('lat') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.district.fields.lat_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="lot">{{ trans('cruds.district.fields.lot') }}</label>
                    <input class="form-control {{ $errors->has('lot') ? 'is-invalid' : '' }}" type="text" name="lot" id="lot" value="{{ old('lot', $district->lot) }}">
                    @if($errors->has('lot'))
                        <div class="invalid-feedback">
                            {{ $errors->first('lot') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.district.fields.lot_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="url">{{ trans('cruds.district.fields.url') }}</label>
                    <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', $district->url) }}">
                    @if($errors->has('url'))
                        <div class="invalid-feedback">
                            {{ $errors->first('url') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.district.fields.url_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.district.fields.is_active') }}</label>
                    <select class="form-control {{ $errors->has('is_active') ? 'is-invalid' : '' }}" name="is_active" id="is_active">
                        <option value disabled {{ old('is_active', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\District::IS_ACTIVE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('is_active', $district->is_active) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('is_active'))
                        <div class="invalid-feedback">
                            {{ $errors->first('is_active') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.district.fields.is_active_helper') }}</span>
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
