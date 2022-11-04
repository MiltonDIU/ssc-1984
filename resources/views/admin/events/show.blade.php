@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.event.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.id') }}
                        </th>
                        <td>
                            {{ $event->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.event_category') }}
                        </th>
                        <td>
                            {{ $event->event_category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.name') }}
                        </th>
                        <td>
                            {{ $event->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.slug') }}
                        </th>
                        <td>
                            {{ $event->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.banner') }}
                        </th>
                        <td>
                            @if($event->banner)
                                <a href="{{ $event->banner->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $event->banner->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.details') }}
                        </th>
                        <td>
                            {!! $event->details !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.event_date') }}
                        </th>
                        <td>
                            {{ $event->event_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.event_time') }}
                        </th>
                        <td>
                            {{ $event->event_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.event_end_time') }}
                        </th>
                        <td>
                            {{ $event->event_end_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.address') }}
                        </th>
                        <td>
                            {{ $event->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.district') }}
                        </th>
                        <td>
                            {{ $event->district->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.is_free') }}
                        </th>
                        <td>
                            {{ App\Models\Event::IS_FREE_SELECT[$event->is_free] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.price') }}
                        </th>
                        <td>
                            {{ $event->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Event::IS_ACTIVE_SELECT[$event->is_active] ?? '' }}
                        </td>
                    </tr>
{{--                    <tr>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.event.fields.user') }}--}}
{{--                        </th>--}}
{{--                        <td>--}}
{{--                            @foreach($event->users as $key => $user)--}}
{{--                                <span class="label label-info">{{ $user->name }}</span>--}}
{{--                            @endforeach--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            {{ trans('global.relatedData') }}
        </div>
        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
            <li class="nav-item">
                <a class="nav-link" href="#event_users" role="tab" data-toggle="tab">
                    {{ trans('cruds.user.name') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="event_users">
                @includeIf('admin.events.relationships.members', ['users' => $event->users])
            </div>
        </div>
    </div>


@endsection
