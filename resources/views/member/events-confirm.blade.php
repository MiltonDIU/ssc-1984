@extends('member.layouts.master')
@section('top_content')
    <div class="dashboard_search">
        <input type="search" placeholder="Search among 3032 Schools">
        <i class="bi bi-search"></i>
    </div>
@endsection
@section('content')


        <div class="event_box_large">

            <p class="event_page_title">{{ $event->name??"" }}</p>
            @if($event->banner)
                @php
                    $url =$event->banner->getUrl();
                @endphp
            @else
                @php
                    $url = 'assets/alumni/images/gray.png';
                @endphp
            @endif

            <div class="event_banner_img">
                <img src="{{ url($url) }}" alt="Event banner">
            </div>

            <div class="event_info_box">
                <div class="event_info_left">
                    <p class="event_sub_title">{{ $event->name??"" }}</p>

                    <div class="event_date_location_box">
                        <div class="event_info_inner">
                            <div class="icon_box">
                                <i class="bi bi-calendar-event"></i>
                            </div>

                            <div class="event_info_text">
                                <p class="info_title">{{ date('l, j, M, Y ', strtotime($event->event_date))  }}</p>
                                <p class="info_text">{{date('h:i A', strtotime($event->event_time)) }} - {{date('h:i A', strtotime($event->event_end_time)) }}</p>
                            </div>
                        </div>

                        <div class="event_info_inner inner_bottom">
                            <div class="icon_box">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>

                            <div class="event_info_text">
                                <p class="info_title">Get Direction</p>
                                <p class="info_text">{{ $event->address }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="event_creator_cost_box">
                        <div class="event_creator">
                            <div class="creator_img">
                                <img src="http://ssc-1984.test/assets/alumni/images/logo.png">
                            </div>
                            <div class="creator_text">
                                <p class="creator_title">Created By</p>
                                <p class="info_text">Spruce Springclean</p>
                            </div>
                        </div>

                        <div class="event_cost">
                            <p class="cost_title">Cost</p>
                            <p class="cost_category">{{ $event->is_free=='0'?$event->price." tk":"Free" }}</p>
                        </div>
                    </div>
                </div>

                <div class="event_info_right">
                    <form class="profile_form mb_24" method="POST" action="{{ route('member.eventConfirmSubmit',[$event->id]) }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="mb-3">
                            <h4>Terms and Condition</h4>
                            <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.</p>
                        </div>

                        <div class="mb-3">
                            <p>
                                Are you coming with your spouse:  <input type="checkbox" name="spouseCheck" class="checkForm" id="spouseCheck" onclick="myFunction()">
                            </p>
                        </div>
                        <div id="spouse">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Spouse Name</label>
                                <input type="text" class="form-control " name="name" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Spouse Picture</label>
                               <div class="form_wrapper mb_24">
                                <div class="needsclick dropzone {{ $errors->has('avatar') ? 'is-invalid' : '' }}" id="avatar-dropzone">
                                </div>
                                @if($errors->has('avatar'))
                                    <span class="text-danger">{{ $errors->first('avatar') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.user.fields.avatar_helper') }}</span>

                            </div>


                            </div>
                        </div>
                        <input type="hidden" class="form-control" value="{{ $event->id }}" name="event_id">
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </form>

                </div>

            </div>
        </div>


@endsection
@push('script')
    @parent
    <script>
        function myFunction() {
            var spouseCheck = document.getElementById("spouseCheck");
            var spouse = document.getElementById("spouse");
            if (spouseCheck.checked == true){
                spouse.style.display = "block";
            } else {
                spouse.style.display = "none";
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>


    <script>
        Dropzone.options.avatarDropzone = {
            url: '{{ route('member.spouse.storeMedia') }}',
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

@endpush




@push('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <style>
        .event_info_right img{ width: 100%}
        .event_box_large{ min-height: 635px;
        height: auto;
        }
        .modal-content{ min-height: 279px; height: auto; min-width: 389px; width: 100%}
        .event_box_large .input_box{ width: 100%; float: left}
#spouse{ display: none}
        .checkForm {
            width: 20px !important;
            height: 20px!important;}

    </style>

@endpush
