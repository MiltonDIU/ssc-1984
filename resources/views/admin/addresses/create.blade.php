@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.address.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.addresses.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="division_id">{{ trans('cruds.address.fields.division') }}</label>
                    <select class="form-control select2 {{ $errors->has('division') ? 'is-invalid' : '' }}" name="division_id" id="division_id">
                        @foreach($divisions as $id => $entry)
                            <option value="{{ $id }}" {{ old('division_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('division'))
                        <span class="text-danger">{{ $errors->first('division') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.address.fields.division_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="district_id">{{ trans('cruds.address.fields.district') }}</label>
                    <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district_id" id="district_id">
                        @foreach($districts as $id => $entry)
                            <option value="{{ $id }}" {{ old('district_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('district'))
                        <span class="text-danger">{{ $errors->first('district') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.address.fields.district_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="upazila_id">{{ trans('cruds.address.fields.upazila') }}</label>
                    <select class="form-control select2 {{ $errors->has('upazila') ? 'is-invalid' : '' }}" name="upazila_id" id="upazila_id">
                        @foreach($upazilas as $id => $entry)
                            <option value="{{ $id }}" {{ old('upazila_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('upazila'))
                        <span class="text-danger">{{ $errors->first('upazila') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.address.fields.upazila_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="area">{{ trans('cruds.address.fields.area') }}</label>
                    <textarea class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" name="area" id="area">{!! old('area') !!}</textarea>
                    @if($errors->has('area'))
                        <span class="text-danger">{{ $errors->first('area') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.address.fields.area_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.address.fields.type_of_address') }}</label>
                    <select class="form-control {{ $errors->has('type_of_address') ? 'is-invalid' : '' }}" name="type_of_address" id="type_of_address" required>
                        <option value disabled {{ old('type_of_address', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Address::TYPE_OF_ADDRESS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('type_of_address', 'Present') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('type_of_address'))
                        <span class="text-danger">{{ $errors->first('type_of_address') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.address.fields.type_of_address_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="user_id">{{ trans('cruds.address.fields.user') }}</label>
                    <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                        @foreach($users as $id => $entry)
                            <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('user'))
                        <span class="text-danger">{{ $errors->first('user') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.address.fields.user_helper') }}</span>
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
        $(document).ready(function () {
            function SimpleUploadAdapter(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                    return {
                        upload: function() {
                            return loader.file
                                .then(function (file) {
                                    return new Promise(function(resolve, reject) {
                                        // Init request
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', '{{ route('admin.addresses.storeCKEditorImages') }}', true);
                                        xhr.setRequestHeader('x-csrf-token', window._token);
                                        xhr.setRequestHeader('Accept', 'application/json');
                                        xhr.responseType = 'json';

                                        // Init listeners
                                        var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                                        xhr.addEventListener('error', function() { reject(genericErrorText) });
                                        xhr.addEventListener('abort', function() { reject() });
                                        xhr.addEventListener('load', function() {
                                            var response = xhr.response;

                                            if (!response || xhr.status !== 201) {
                                                return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                                            }

                                            $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                                            resolve({ default: response.url });
                                        });

                                        if (xhr.upload) {
                                            xhr.upload.addEventListener('progress', function(e) {
                                                if (e.lengthComputable) {
                                                    loader.uploadTotal = e.total;
                                                    loader.uploaded = e.loaded;
                                                }
                                            });
                                        }

                                        // Send request
                                        var data = new FormData();
                                        data.append('upload', file);
                                        data.append('crud_id', '{{ $address->id ?? 0 }}');
                                        xhr.send(data);
                                    });
                                })
                        }
                    };
                }
            }

            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor.create(
                    allEditors[i], {
                        extraPlugins: [SimpleUploadAdapter]
                    }
                );
            }
        });
    </script>

@endsection
