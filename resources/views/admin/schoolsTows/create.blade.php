@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.schoolsTow.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.schools-tows.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.schoolsTow.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolsTow.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="slug">{{ trans('cruds.schoolsTow.fields.slug') }}</label>
                    <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}">
                    @if($errors->has('slug'))
                        <span class="text-danger">{{ $errors->first('slug') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolsTow.fields.slug_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="district">{{ trans('cruds.schoolsTow.fields.district') }}</label>
                    <input class="form-control {{ $errors->has('district') ? 'is-invalid' : '' }}" type="text" name="district" id="district" value="{{ old('district', '') }}">
                    @if($errors->has('district'))
                        <span class="text-danger">{{ $errors->first('district') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolsTow.fields.district_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="upazila">{{ trans('cruds.schoolsTow.fields.upazila') }}</label>
                    <input class="form-control {{ $errors->has('upazila') ? 'is-invalid' : '' }}" type="text" name="upazila" id="upazila" value="{{ old('upazila', '') }}">
                    @if($errors->has('upazila'))
                        <span class="text-danger">{{ $errors->first('upazila') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolsTow.fields.upazila_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="eiin">{{ trans('cruds.schoolsTow.fields.eiin') }}</label>
                    <input class="form-control {{ $errors->has('eiin') ? 'is-invalid' : '' }}" type="text" name="eiin" id="eiin" value="{{ old('eiin', '') }}">
                    @if($errors->has('eiin'))
                        <span class="text-danger">{{ $errors->first('eiin') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolsTow.fields.eiin_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="mobile">{{ trans('cruds.schoolsTow.fields.mobile') }}</label>
                    <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', '') }}">
                    @if($errors->has('mobile'))
                        <span class="text-danger">{{ $errors->first('mobile') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolsTow.fields.mobile_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="management">{{ trans('cruds.schoolsTow.fields.management') }}</label>
                    <input class="form-control {{ $errors->has('management') ? 'is-invalid' : '' }}" type="text" name="management" id="management" value="{{ old('management', '') }}">
                    @if($errors->has('management'))
                        <span class="text-danger">{{ $errors->first('management') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolsTow.fields.management_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="mpo">{{ trans('cruds.schoolsTow.fields.mpo') }}</label>
                    <input class="form-control {{ $errors->has('mpo') ? 'is-invalid' : '' }}" type="text" name="mpo" id="mpo" value="{{ old('mpo', '') }}">
                    @if($errors->has('mpo'))
                        <span class="text-danger">{{ $errors->first('mpo') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolsTow.fields.mpo_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="post_office">{{ trans('cruds.schoolsTow.fields.post_office') }}</label>
                    <input class="form-control {{ $errors->has('post_office') ? 'is-invalid' : '' }}" type="text" name="post_office" id="post_office" value="{{ old('post_office', '') }}">
                    @if($errors->has('post_office'))
                        <span class="text-danger">{{ $errors->first('post_office') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolsTow.fields.post_office_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="address">{{ trans('cruds.schoolsTow.fields.address') }}</label>
                    <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address') }}</textarea>
                    @if($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolsTow.fields.address_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.schoolsTow.fields.is_approve') }}</label>
                    <select class="form-control {{ $errors->has('is_approve') ? 'is-invalid' : '' }}" name="is_approve" id="is_approve">
                        <option value disabled {{ old('is_approve', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\SchoolsTow::IS_APPROVE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('is_approve', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('is_approve'))
                        <span class="text-danger">{{ $errors->first('is_approve') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolsTow.fields.is_approve_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.schoolsTow.fields.is_active') }}</label>
                    <select class="form-control {{ $errors->has('is_active') ? 'is-invalid' : '' }}" name="is_active" id="is_active" required>
                        <option value disabled {{ old('is_active', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\SchoolsTow::IS_ACTIVE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('is_active', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('is_active'))
                        <span class="text-danger">{{ $errors->first('is_active') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolsTow.fields.is_active_helper') }}</span>
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
