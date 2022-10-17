@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="email">{{ trans('cruds.user.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="mobile">{{ trans('cruds.user.fields.mobile') }}</label>
                    <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', $user->mobile) }}" required>
                    @if($errors->has('mobile'))
                        <span class="text-danger">{{ $errors->first('mobile') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.mobile_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="telephone_number">{{ trans('cruds.user.fields.telephone_number') }}</label>
                    <input class="form-control {{ $errors->has('telephone_number') ? 'is-invalid' : '' }}" type="text" name="telephone_number" id="telephone_number" value="{{ old('telephone_number', $user->telephone_number) }}">
                    @if($errors->has('telephone_number'))
                        <span class="text-danger">{{ $errors->first('telephone_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.telephone_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.user.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                        <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\User::GENDER_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('gender', $user->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.gender_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="date_of_birth">{{ trans('cruds.user.fields.date_of_birth') }}</label>
                    <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}" required>
                    @if($errors->has('date_of_birth'))
                        <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.date_of_birth_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="blood_group">{{ trans('cruds.user.fields.blood_group') }}</label>
                    <input class="form-control {{ $errors->has('blood_group') ? 'is-invalid' : '' }}" type="text" name="blood_group" id="blood_group" value="{{ old('blood_group', $user->blood_group) }}">
                    @if($errors->has('blood_group'))
                        <span class="text-danger">{{ $errors->first('blood_group') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.blood_group_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="avatar">{{ trans('cruds.user.fields.avatar') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('avatar') ? 'is-invalid' : '' }}" id="avatar-dropzone">
                    </div>
                    @if($errors->has('avatar'))
                        <span class="text-danger">{{ $errors->first('avatar') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.avatar_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="school_id">{{ trans('cruds.user.fields.school') }}</label>
                    <select class="form-control select2 {{ $errors->has('school') ? 'is-invalid' : '' }}" name="school_id" id="school_id" required>
                        @foreach($schools as $id => $entry)
                            <option value="{{ $id }}" {{ (old('school_id') ? old('school_id') : $user->school->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('school'))
                        <span class="text-danger">{{ $errors->first('school') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.school_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="professions">{{ trans('cruds.user.fields.profession') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('professions') ? 'is-invalid' : '' }}" name="professions[]" id="professions" multiple required>
                        @foreach($professions as $id => $profession)
                            <option value="{{ $id }}" {{ (in_array($id, old('professions', [])) || $user->professions->contains($id)) ? 'selected' : '' }}>{{ $profession }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('professions'))
                        <span class="text-danger">{{ $errors->first('professions') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.profession_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="division_id">{{ trans('cruds.user.fields.division') }}</label>
                    <select class="form-control select2 {{ $errors->has('division') ? 'is-invalid' : '' }}" name="division_id" id="division_id" required>
                        @foreach($divisions as $id => $entry)
                            <option value="{{ $id }}" {{ (old('division_id') ? old('division_id') : $user->division->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('division'))
                        <span class="text-danger">{{ $errors->first('division') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.division_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="district_id">{{ trans('cruds.user.fields.district') }}</label>
                    <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district_id" id="district_id" required>
                        @foreach($districts as $id => $entry)
                            <option value="{{ $id }}" {{ (old('district_id') ? old('district_id') : $user->district->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('district'))
                        <span class="text-danger">{{ $errors->first('district') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.district_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="upazila_id">{{ trans('cruds.user.fields.upazila') }}</label>
                    <select class="form-control select2 {{ $errors->has('upazila') ? 'is-invalid' : '' }}" name="upazila_id" id="upazila_id" required>
                        @foreach($upazilas as $id => $entry)
                            <option value="{{ $id }}" {{ (old('upazila_id') ? old('upazila_id') : $user->upazila->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('upazila'))
                        <span class="text-danger">{{ $errors->first('upazila') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.upazila_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                        @foreach($roles as $id => $role)
                            <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('roles'))
                        <span class="text-danger">{{ $errors->first('roles') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="id_ssc_bd">{{ trans('cruds.user.fields.id_ssc_bd') }}</label>
                    <input class="form-control {{ $errors->has('id_ssc_bd') ? 'is-invalid' : '' }}" type="text" name="id_ssc_bd" id="id_ssc_bd" value="{{ old('id_ssc_bd', $user->id_ssc_bd) }}">
                    @if($errors->has('id_ssc_bd'))
                        <span class="text-danger">{{ $errors->first('id_ssc_bd') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.id_ssc_bd_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="id_ssc_district">{{ trans('cruds.user.fields.id_ssc_district') }}</label>
                    <input class="form-control {{ $errors->has('id_ssc_district') ? 'is-invalid' : '' }}" type="text" name="id_ssc_district" id="id_ssc_district" value="{{ old('id_ssc_district', $user->id_ssc_district) }}">
                    @if($errors->has('id_ssc_district'))
                        <span class="text-danger">{{ $errors->first('id_ssc_district') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.id_ssc_district_helper') }}</span>
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

@section('scripts')
    <script>
        Dropzone.options.avatarDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 1, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 1,
                width: 4096,
                height: 4096
            },
            success: function (file, response) {
                $('form').find('input[name="avatar"]').remove()
                $('form').append('<input type="hidden" name="avatar" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="avatar"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($user) && $user->avatar)
                var file = {!! json_encode($user->avatar) !!}
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="avatar" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }

    </script>
@endsection