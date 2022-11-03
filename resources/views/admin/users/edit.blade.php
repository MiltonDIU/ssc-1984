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
                <div class="row">
                    <div class="col-md-12"><h4>Personal Information</h4></div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                                    @if($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ trans('cruds.user.fields.email') }}</label>
                                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
                                    @if($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required" for="mobile">{{ trans('cruds.user.fields.mobile') }}</label>
                                    <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', $user->mobile) }}" required>
                                    @if($errors->has('mobile'))
                                        <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.mobile_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telephone_number">{{ trans('cruds.user.fields.telephone_number') }}</label>
                                    <input class="form-control {{ $errors->has('telephone_number') ? 'is-invalid' : '' }}" type="text" name="telephone_number" id="telephone_number" value="{{ old('telephone_number', $user->telephone_number) }}">
                                    @if($errors->has('telephone_number'))
                                        <span class="text-danger">{{ $errors->first('telephone_number') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.telephone_number_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="required" for="date_of_birth">{{ trans('cruds.user.fields.date_of_birth') }}</label>
                                    <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth',$user->date_of_birth) }}" required>
                                    @if($errors->has('date_of_birth'))
                                        <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.date_of_birth_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ trans('cruds.user.fields.blood_group') }}</label>
                                    <select class="form-control {{ $errors->has('blood_group') ? 'is-invalid' : '' }}" name="blood_group" id="blood_group">
                                        <option value disabled {{ old('blood_group', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\User::BLOOD_GROUP_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('blood_group', $user->blood_group) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('blood_group'))
                                        <span class="text-danger">{{ $errors->first('blood_group') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.blood_group_helper') }}</span>
                                </div>
                            </div>

                            <div class="col-md-4">
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
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="avatar">{{ trans('cruds.user.fields.avatar') }}</label>
                            <div class="needsclick dropzone {{ $errors->has('avatar') ? 'is-invalid' : '' }}" id="avatar-dropzone">
                            </div>
                            @if($errors->has('avatar'))
                                <span class="text-danger">{{ $errors->first('avatar') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.avatar_helper') }}</span>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12"><h4>Schools Information</h4></div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="sdivision_id">{{ trans('cruds.user.fields.division') }}</label>
                            <select class="form-control select2 {{ $errors->has('division') ? 'is-invalid' : '' }}" name="sdivision_id" id="sdivision_id" required>
                                @foreach($divisions as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('division_id') ? old('division_id') : $user->division->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>

                                @endforeach
                            </select>
                            @if($errors->has('sdivision'))
                                <span class="text-danger">{{ $errors->first('sdivision') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.division_helper') }}</span>
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="ddistrict_id">{{ trans('cruds.user.fields.district') }}</label>
                            <select class="form-control select2 {{ $errors->has('sdistrict') ? 'is-invalid' : '' }}" name="sdistrict_id" id="sdistrict_id" required>
                                <option value="{{ $user->district->id }}" {{ (old('district_id') ? old('district_id') : $user->district->id ?? '') == $id ? 'selected' : '' }}>{{ $user->district->name }}</option>

                                <option value="">{{ trans('global.pleaseSelect') }}</option>
                            </select>
                            @if($errors->has('sdistrict'))
                                <span class="text-danger">{{ $errors->first('sdistrict') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.district_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="supazila_id">{{ trans('cruds.user.fields.upazila') }}</label>
                            <select class="form-control select2 {{ $errors->has('supazila') ? 'is-invalid' : '' }}" name="supazila_id" id="supazila_id" required>
                                <option value="{{ $user->upazila->id }}" {{ (old('upazila_id') ? old('upazila_id') : $user->upazila->id ?? '') == $id ? 'selected' : '' }}>{{ $user->upazila->name }}</option>

                                <option value="">{{ trans('global.pleaseSelect') }}</option>
                            </select>
                            @if($errors->has('supazila'))
                                <span class="text-danger">{{ $errors->first('supazila') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.upazila_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="school_id">{{ trans('cruds.user.fields.school') }}</label>

                            <select class="form-control select2 {{ $errors->has('school') ? 'is-invalid' : '' }}" name="school_id" id="school_id" required>

                                <option value="{{ $user->school->id }}" {{ (old('school_id') ? old('school_id') : $user->school->id ?? '') == $id ? 'selected' : '' }}>{{ $user->school->name }}</option>
                                <option value="">{{ trans('global.pleaseSelect') }}</option>
                            </select>
                            @if($errors->has('school'))
                                <span class="text-danger">{{ $errors->first('school') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.school_helper') }}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12"><h4>Professional Information</h4></div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="required" for="professions">{{ trans('cruds.user.fields.profession') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>

                            <select class="form-control select2 {{ $errors->has('professions') ? 'is-invalid' : '' }}" name="professions[]" id="professions" multiple required>
                                @foreach($professions as $id => $profession)

                                    <option value="{{ $id }}" {{ (in_array($id, old('professions', [])) || $user->professions->contains($id)) ? 'selected' : '' }}>{{ $profession }}</option>

                                    @if(count(\App\Models\Profession::parentProfession($id))>0)
                                        @include('admin.professions.parent-profession',['id'=>$id,'profession'=>$profession,'user'=>$user])
                                    @endif


                                @endforeach
                            </select>
                            @if($errors->has('professions'))
                                <span class="text-danger">{{ $errors->first('professions') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.profession_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12"><h4>Represent Information</h4></div>
                    <div class="col-md-4">
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
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="required" for="district_id">{{ trans('cruds.user.fields.district') }}</label>
                            <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district_id" id="district_id" required>
                                <option value="{{ $user->district->id }}" {{ (old('district_id') ? old('district_id') : $user->district->id ?? '') == $id ? 'selected' : '' }}>{{ $user->district->name }}</option>

                                <option value="">{{ trans('global.pleaseSelect') }}</option>
                            </select>
                            @if($errors->has('district'))
                                <span class="text-danger">{{ $errors->first('district') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.district_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="required" for="upazila_id">{{ trans('cruds.user.fields.upazila') }}</label>
                            <select class="form-control select2 {{ $errors->has('upazila') ? 'is-invalid' : '' }}" name="upazila_id" id="upazila_id" required>
                                <option value="{{ $user->upazila->id }}" {{ (old('upazila_id') ? old('upazila_id') : $user->upazila->id ?? '') == $id ? 'selected' : '' }}>{{ $user->upazila->name }}</option>

                                <option value="">{{ trans('global.pleaseSelect') }}</option>
                            </select>
                            @if($errors->has('upazila'))
                                <span class="text-danger">{{ $errors->first('upazila') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.upazila_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12"><h4>Present Address Information</h4></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="division_id">{{ trans('cruds.user.fields.division') }}</label>
                            <select class="form-control select2 {{ $errors->has('address_division') ? 'is-invalid' : '' }}" name="address_division_id" id="address_division_id" required>
                                @foreach($divisions as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('division_id') ? old('division_id') : $user->userAddresses[0]->division_id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('address_division'))
                                <span class="text-danger">{{ $errors->first('address_division') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.division_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="address_district_id">{{ trans('cruds.user.fields.district') }}</label>
                            <select class="form-control select2 {{ $errors->has('address_district') ? 'is-invalid' : '' }}" name="address_district_id" id="address_district_id" required>
                                <option value="{{ $user->userAddresses[0]->district_id }}" {{ (old('district_id') ? old('district_id') : $user->userAddresses[0]->district_id ?? '') == $id ? 'selected' : '' }}>{{ $user->userAddresses[0]->district->name }}</option>

                                <option value="">{{ trans('global.pleaseSelect') }}</option>
                            </select>
                            @if($errors->has('address_district'))
                                <span class="text-danger">{{ $errors->first('address_district') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.district_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="upazila_id">{{ trans('cruds.user.fields.upazila') }}</label>
                            <select class="form-control select2 {{ $errors->has('address_upazila') ? 'is-invalid' : '' }}" name="address_upazila_id" id="address_upazila_id" required>
                                <option value="{{ $user->upazila->id }}" {{ (old('upazila_id') ? old('upazila_id') : $user->userAddresses[0]->upazila_id ?? '') == $id ? 'selected' : '' }}>{{ $user->upazila->name }}</option>

                                <option value="">{{ trans('global.pleaseSelect') }}</option>
                            </select>
                            @if($errors->has('address_upazila'))
                                <span class="text-danger">{{ $errors->first('address_upazila') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.upazila_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="area">{{ trans('cruds.address.fields.area') }}</label>
                            <textarea class="form-control ckeditor {{ $errors->has('area') ? 'is-invalid' : '' }}" name="area" id="area">{!! old('area') !!}</textarea>
                            @if($errors->has('area'))
                                <span class="text-danger">{{ $errors->first('area') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.address.fields.area_helper') }}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12"><h4>User Information</h4></div>
                    <div class="col-md-3">
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
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                            <input style="margin-top:29px" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div class="form-group">
                            <label for="id_ssc_bd">{{ trans('cruds.user.fields.id_ssc_bd') }}</label>
                            <input style="margin-top:29px" class="form-control {{ $errors->has('id_ssc_bd') ? 'is-invalid' : '' }}" type="text" disabled name="id_ssc_bd" id="id_ssc_bd" value="{{ old('id_ssc_bd', $user->id_ssc_bd) }}">
                            @if($errors->has('id_ssc_bd'))
                                <span class="text-danger">{{ $errors->first('id_ssc_bd') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.id_ssc_bd_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="id_ssc_district">{{ trans('cruds.user.fields.id_ssc_district') }}</label>
                            <input style="margin-top:29px" class="form-control {{ $errors->has('id_ssc_district') ? 'is-invalid' : '' }}" disabled type="text" name="id_ssc_district" id="id_ssc_district" value="{{ old('id_ssc_district', $user->id_ssc_district) }}">
                            @if($errors->has('id_ssc_district'))
                                <span class="text-danger">{{ $errors->first('id_ssc_district') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.id_ssc_district_helper') }}</span>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.update') }}
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
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
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

    <script type="text/javascript">
        $("#division_id").change(function(){
            $.ajax({
                url: "{{ route('admin.district.get_by_division') }}?division_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('#district_id').html(data.html);
                }
            });
        });

        $("#district_id").change(function(){
            $.ajax({
                url: "{{ route('admin.upazila.get_by_district') }}?district_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('#upazila_id').html(data.html);
                }
            });
        });

        //Address information
        $("#address_division_id").change(function(){
            $.ajax({
                url: "{{ route('admin.district.get_by_division') }}?division_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('#address_district_id').html(data.html);
                }
            });
        });

        $("#address_district_id").change(function(){
            $.ajax({
                url: "{{ route('admin.upazila.get_by_district') }}?district_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('#address_upazila_id').html(data.html);
                }
            });
        });


        //schools information
        $("#sdivision_id").change(function(){
            $.ajax({
                url: "{{ route('admin.district.get_by_division') }}?division_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('#sdistrict_id').html(data.html);
                }
            });
        });

        $("#sdistrict_id").change(function(){
            $.ajax({
                url: "{{ route('admin.upazila.get_by_district') }}?district_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('#supazila_id').html(data.html);
                }
            });
        });
        $("#supazila_id").change(function(){
            $.ajax({
                url: "{{ route('admin.schools.get_by_upazila') }}?upazila_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('#school_id').html(data.html);
                }
            });
        });
    </script>
@endsection
