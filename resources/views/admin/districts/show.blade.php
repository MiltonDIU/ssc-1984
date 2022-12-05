@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.district.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.districts.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.district.fields.id') }}
                        </th>
                        <td>
                            {{ $district->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.district.fields.division') }}
                        </th>
                        <td>
                            {{ $district->division->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.district.fields.name') }}
                        </th>
                        <td>
                            {{ $district->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.district.fields.slug') }}
                        </th>
                        <td>
                            {{ $district->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.district.fields.bn_name') }}
                        </th>
                        <td>
                            {{ $district->bn_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.district.fields.lat') }}
                        </th>
                        <td>
                            {{ $district->lat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.district.fields.lot') }}
                        </th>
                        <td>
                            {{ $district->lot }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.district.fields.url') }}
                        </th>
                        <td>
                            {{ $district->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.district.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\District::IS_ACTIVE_SELECT[$district->is_active] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.districts.index') }}">
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
                <a class="nav-link" href="#district_upazilas" role="tab" data-toggle="tab">
                    {{ trans('cruds.upazila.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#district_events" role="tab" data-toggle="tab">
                    {{ trans('cruds.event.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#district_users" role="tab" data-toggle="tab">
                    {{ trans('cruds.user.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="district_upazilas">
                @includeIf('admin.districts.relationships.districtUpazilas', ['upazilas' => $district->districtUpazilas])
            </div>
            <div class="tab-pane" role="tabpanel" id="district_events">
                @includeIf('admin.districts.relationships.districtEvents', ['events' => $district->districtEvents])
            </div>
            <div class="tab-pane" role="tabpanel" id="district_users">
                @includeIf('admin.districts.relationships.districtUsers', ['users' => $district->districtUsers])
            </div>
        </div>
    </div>

@endsection
