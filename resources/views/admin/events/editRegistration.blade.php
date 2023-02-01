@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
           Registration Edit
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.registrationUpdate') }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf


                <div class="form-group">
                    <label>{{ trans('cruds.spouse.fields.driver') }}</label>
                    @foreach(App\Models\Spouse::DRIVER_RADIO as $key => $label)
                        <div class="form-check {{ $errors->has('driver') ? 'is-invalid' : '' }}">
                            <input class="form-check-input" type="radio" id="driver_{{ $key }}" name="driver" value="{{ $key }}" {{ old('driver', $eventUser->driver) === (string) $key ? 'checked' : '' }}>
                            <label class="form-check-label" for="driver_{{ $key }}">{{ $label }}</label>
                        </div>
                    @endforeach
                    @if($errors->has('driver'))
                        <div class="invalid-feedback">
                            {{ $errors->first('driver') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.spouse.fields.driver_helper') }}</span>
                </div>

                <div class="form-group">
                    <div class="form-check {{ $errors->has('spouse') ? 'is-invalid' : '' }}">
                        <input type="hidden" name="spouse" value="0">
                        <input class="form-check-input" type="checkbox" name="spouse" id="spouse" value="1" {{ $eventUser->spouse || old('spouse', 0) === 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="spouse">{{ trans('cruds.spouse.fields.spouse') }}</label>
                    </div>
                    @if($errors->has('spouse'))
                        <div class="invalid-feedback">
                            {{ $errors->first('spouse') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.spouse.fields.spouse_helper') }}</span>
                </div>


                <div class="form-group">
                    <input type="hidden" name="id" value="{{ $reg_id }}">
                    <input type="hidden" name="event_id" value="{{ $eventUser->event_id }}">
                    <input type="hidden" name="user_id" value="{{ $eventUser->user_id }}">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
