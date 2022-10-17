@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.eventCategory.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.event-categories.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.eventCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $eventCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventCategory.fields.name') }}
                        </th>
                        <td>
                            {{ $eventCategory->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventCategory.fields.slug') }}
                        </th>
                        <td>
                            {{ $eventCategory->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventCategory.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\EventCategory::IS_ACTIVE_SELECT[$eventCategory->is_active] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.event-categories.index') }}">
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
                <a class="nav-link" href="#event_category_events" role="tab" data-toggle="tab">
                    {{ trans('cruds.event.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="event_category_events">
                @includeIf('admin.eventCategories.relationships.eventCategoryEvents', ['events' => $eventCategory->eventCategoryEvents])
            </div>
        </div>
    </div>

@endsection
