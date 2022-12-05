@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.event.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.events.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required" for="event_category_id">{{ trans('cruds.event.fields.event_category') }}</label>
                                    <select class="form-control select2 {{ $errors->has('event_category') ? 'is-invalid' : '' }}" name="event_category_id" id="event_category_id" required>
                                        @foreach($event_categories as $id => $entry)
                                            <option value="{{ $id }}" {{ old('event_category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('event_category'))
                                        <span class="text-danger">{{ $errors->first('event_category') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.event.fields.event_category_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required" for="name">{{ trans('cruds.event.fields.name') }}</label>
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                                    @if($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.event.fields.name_helper') }}</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="required" for="event_date">{{ trans('cruds.event.fields.event_date') }}</label>
                                    <input class="form-control date {{ $errors->has('event_date') ? 'is-invalid' : '' }}" type="text" name="event_date" id="event_date" value="{{ old('event_date') }}" required>
                                    @if($errors->has('event_date'))
                                        <span class="text-danger">{{ $errors->first('event_date') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.event.fields.event_date_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="required" for="event_time">{{ trans('cruds.event.fields.event_time') }}</label>
                                    <input class="form-control timepicker {{ $errors->has('event_time') ? 'is-invalid' : '' }}" type="text" name="event_time" id="event_time" value="{{ old('event_time') }}" required>
                                    @if($errors->has('event_time'))
                                        <span class="text-danger">{{ $errors->first('event_time') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.event.fields.event_time_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="required" for="event_end_time">{{ trans('cruds.event.fields.event_end_time') }}</label>
                                    <input class="form-control timepicker {{ $errors->has('event_end_time') ? 'is-invalid' : '' }}" type="text" name="event_end_time" id="event_end_time" value="{{ old('event_end_time') }}" required>
                                    @if($errors->has('event_end_time'))
                                        <span class="text-danger">{{ $errors->first('event_end_time') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.event.fields.event_end_time_helper') }}</span>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="details">{{ trans('cruds.event.fields.details') }}</label>
                                    <textarea class="form-control ckeditor {{ $errors->has('details') ? 'is-invalid' : '' }}" name="details" id="details">{!! old('details') !!}</textarea>
                                    @if($errors->has('details'))
                                        <span class="text-danger">{{ $errors->first('details') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.event.fields.details_helper') }}</span>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required" for="district_id">{{ trans('cruds.event.fields.district') }}</label>
                                        <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district_id" id="district_id" required>
                                            @foreach($districts as $id => $entry)
                                                <option value="{{ $id }}" {{ old('district_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('district'))
                                            <span class="text-danger">{{ $errors->first('district') }}</span>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.event.fields.district_helper') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('cruds.event.fields.is_free') }}</label>
                                        <select class="form-control {{ $errors->has('is_free') ? 'is-invalid' : '' }}" name="is_free" id="is_free">
                                            <option value disabled {{ old('is_free', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                            @foreach(App\Models\Event::IS_FREE_SELECT as $key => $label)
                                                <option value="{{ $key }}" {{ old('is_free', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('is_free'))
                                            <span class="text-danger">{{ $errors->first('is_free') }}</span>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.event.fields.is_free_helper') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">{{ trans('cruds.event.fields.address') }}</label>
                                        <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address') }}</textarea>
                                        @if($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.event.fields.address_helper') }}</span>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="price">{{ trans('cruds.event.fields.price') }}</label>
                                            <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="text" name="price" id="price" value="{{ old('price', '') }}">
                                            @if($errors->has('price'))
                                                <span class="text-danger">{{ $errors->first('price') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.event.fields.price_helper') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="required">{{ trans('cruds.event.fields.is_active') }}</label>
                                            <select class="form-control {{ $errors->has('is_active') ? 'is-invalid' : '' }}" name="is_active" id="is_active" required>
                                                <option value disabled {{ old('is_active', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                @foreach(App\Models\Event::IS_ACTIVE_SELECT as $key => $label)
                                                    <option value="{{ $key }}" {{ old('is_active', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('is_active'))
                                                <span class="text-danger">{{ $errors->first('is_active') }}</span>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.event.fields.is_active_helper') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="required" for="banner">{{ trans('cruds.event.fields.banner') }}</label>
                            <div class="needsclick dropzone {{ $errors->has('banner') ? 'is-invalid' : '' }}" id="banner-dropzone">
                            </div>
                            @if($errors->has('banner'))
                                <span class="text-danger">{{ $errors->first('banner') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.banner_helper') }}</span>
                        </div>
                    </div>

                </div>


{{--                <div class="form-group">--}}
{{--                    <label class="required" for="slug">{{ trans('cruds.event.fields.slug') }}</label>--}}
{{--                    <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}" required>--}}
{{--                    @if($errors->has('slug'))--}}
{{--                        <span class="text-danger">{{ $errors->first('slug') }}</span>--}}
{{--                    @endif--}}
{{--                    <span class="help-block">{{ trans('cruds.event.fields.slug_helper') }}</span>--}}
{{--                </div>--}}





{{--                --}}
{{--                <div class="form-group">--}}
{{--                    <label for="users">{{ trans('cruds.event.fields.user') }}</label>--}}
{{--                    <div style="padding-bottom: 4px">--}}
{{--                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>--}}
{{--                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>--}}
{{--                    </div>--}}
{{--                    <select class="form-control select2 {{ $errors->has('users') ? 'is-invalid' : '' }}" name="users[]" id="users" multiple>--}}
{{--                        @foreach($users as $id => $user)--}}
{{--                            <option value="{{ $id }}" {{ in_array($id, old('users', [])) ? 'selected' : '' }}>{{ $user }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                    @if($errors->has('users'))--}}
{{--                        <span class="text-danger">{{ $errors->first('users') }}</span>--}}
{{--                    @endif--}}
{{--                    <span class="help-block">{{ trans('cruds.event.fields.user_helper') }}</span>--}}
{{--                </div>--}}
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection

@section('scripts')
    <script>
        Dropzone.options.bannerDropzone = {
            url: '{{ route('admin.events.storeMedia') }}',
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
                $('form').find('input[name="banner"]').remove()
                $('form').append('<input type="hidden" name="banner" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="banner"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($event) && $event->banner)
                var file = {!! json_encode($event->banner) !!}
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="banner" value="' + file.file_name + '">')
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
                                        xhr.open('POST', '{{ route('admin.events.storeCKEditorImages') }}', true);
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
                                        data.append('crud_id', '{{ $event->id ?? 0 }}');
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
