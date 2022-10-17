@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.upazila.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.upazilas.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.upazila.fields.id') }}
                        </th>
                        <td>
                            {{ $upazila->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.upazila.fields.district') }}
                        </th>
                        <td>
                            {{ $upazila->district->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.upazila.fields.name') }}
                        </th>
                        <td>
                            {{ $upazila->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.upazila.fields.slug') }}
                        </th>
                        <td>
                            {{ $upazila->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.upazila.fields.bn_name') }}
                        </th>
                        <td>
                            {{ $upazila->bn_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.upazila.fields.url') }}
                        </th>
                        <td>
                            {{ $upazila->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.upazila.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Upazila::IS_ACTIVE_SELECT[$upazila->is_active] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.upazilas.index') }}">
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
                <a class="nav-link" href="#upazila_schools" role="tab" data-toggle="tab">
                    {{ trans('cruds.school.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#upazila_addresses" role="tab" data-toggle="tab">
                    {{ trans('cruds.address.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#upazila_users" role="tab" data-toggle="tab">
                    {{ trans('cruds.user.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="upazila_schools">
                @includeIf('admin.upazilas.relationships.upazilaSchools', ['schools' => $upazila->upazilaSchools])
            </div>
            <div class="tab-pane" role="tabpanel" id="upazila_addresses">
                @includeIf('admin.upazilas.relationships.upazilaAddresses', ['addresses' => $upazila->upazilaAddresses])
            </div>
            <div class="tab-pane" role="tabpanel" id="upazila_users">
                @includeIf('admin.upazilas.relationships.upazilaUsers', ['users' => $upazila->upazilaUsers])
            </div>
        </div>
    </div>

@endsection
