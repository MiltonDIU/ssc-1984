@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.school.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.schools.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.school.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="slug">{{ trans('cruds.school.fields.slug') }}</label>
                    <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}">
                    @if($errors->has('slug'))
                        <span class="text-danger">{{ $errors->first('slug') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.slug_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="division_id">{{ trans('cruds.school.fields.division') }}</label>
                    <select class="form-control select2 {{ $errors->has('division') ? 'is-invalid' : '' }}" name="division_id" id="division_id" required>
                        @foreach($divisions as $id => $entry)
                            <option value="{{ $id }}" {{ old('division_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('division'))
                        <span class="text-danger">{{ $errors->first('division') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.division_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="district_id">{{ trans('cruds.school.fields.district') }}</label>
                    <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district_id" id="district_id" required>
                        @foreach($districts as $id => $entry)
                            <option value="{{ $id }}" {{ old('district_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('district'))
                        <span class="text-danger">{{ $errors->first('district') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.district_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="upazila_id">{{ trans('cruds.school.fields.upazila') }}</label>
                    <select class="form-control select2 {{ $errors->has('upazila') ? 'is-invalid' : '' }}" name="upazila_id" id="upazila_id" required>
                        @foreach($upazilas as $id => $entry)
                            <option value="{{ $id }}" {{ old('upazila_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('upazila'))
                        <span class="text-danger">{{ $errors->first('upazila') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.upazila_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="eiin">{{ trans('cruds.school.fields.eiin') }}</label>
                    <input class="form-control {{ $errors->has('eiin') ? 'is-invalid' : '' }}" type="text" name="eiin" id="eiin" value="{{ old('eiin', '') }}">
                    @if($errors->has('eiin'))
                        <span class="text-danger">{{ $errors->first('eiin') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.eiin_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="mobile">{{ trans('cruds.school.fields.mobile') }}</label>
                    <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', '') }}">
                    @if($errors->has('mobile'))
                        <span class="text-danger">{{ $errors->first('mobile') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.mobile_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="management">{{ trans('cruds.school.fields.management') }}</label>
                    <input class="form-control {{ $errors->has('management') ? 'is-invalid' : '' }}" type="text" name="management" id="management" value="{{ old('management', '') }}">
                    @if($errors->has('management'))
                        <span class="text-danger">{{ $errors->first('management') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.management_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="mpo">{{ trans('cruds.school.fields.mpo') }}</label>
                    <input class="form-control {{ $errors->has('mpo') ? 'is-invalid' : '' }}" type="text" name="mpo" id="mpo" value="{{ old('mpo', '') }}">
                    @if($errors->has('mpo'))
                        <span class="text-danger">{{ $errors->first('mpo') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.mpo_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="post_office">{{ trans('cruds.school.fields.post_office') }}</label>
                    <input class="form-control {{ $errors->has('post_office') ? 'is-invalid' : '' }}" type="text" name="post_office" id="post_office" value="{{ old('post_office', '') }}">
                    @if($errors->has('post_office'))
                        <span class="text-danger">{{ $errors->first('post_office') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.post_office_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="address">{{ trans('cruds.school.fields.address') }}</label>
                    <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address') }}</textarea>
                    @if($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.address_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.school.fields.is_approve') }}</label>
                    <select class="form-control {{ $errors->has('is_approve') ? 'is-invalid' : '' }}" name="is_approve" id="is_approve">
                        <option value disabled {{ old('is_approve', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\School::IS_APPROVE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('is_approve', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('is_approve'))
                        <span class="text-danger">{{ $errors->first('is_approve') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.is_approve_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.school.fields.is_active') }}</label>
                    <select class="form-control {{ $errors->has('is_active') ? 'is-invalid' : '' }}" name="is_active" id="is_active" required>
                        <option value disabled {{ old('is_active', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\School::IS_ACTIVE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('is_active', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('is_active'))
                        <span class="text-danger">{{ $errors->first('is_active') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.is_active_helper') }}</span>
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
