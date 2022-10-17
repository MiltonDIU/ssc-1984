@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.division.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.divisions.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.division.fields.id') }}
                        </th>
                        <td>
                            {{ $division->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.division.fields.name') }}
                        </th>
                        <td>
                            {{ $division->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.division.fields.bn_name') }}
                        </th>
                        <td>
                            {{ $division->bn_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.division.fields.url') }}
                        </th>
                        <td>
                            {{ $division->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.division.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Division::IS_ACTIVE_SELECT[$division->is_active] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.divisions.index') }}">
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
                <a class="nav-link" href="#division_districts" role="tab" data-toggle="tab">
                    {{ trans('cruds.district.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#division_schools" role="tab" data-toggle="tab">
                    {{ trans('cruds.school.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#division_addresses" role="tab" data-toggle="tab">
                    {{ trans('cruds.address.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="division_districts">
                @includeIf('admin.divisions.relationships.divisionDistricts', ['districts' => $division->divisionDistricts])
            </div>
            <div class="tab-pane" role="tabpanel" id="division_schools">
                @includeIf('admin.divisions.relationships.divisionSchools', ['schools' => $division->divisionSchools])
            </div>
            <div class="tab-pane" role="tabpanel" id="division_addresses">
                @includeIf('admin.divisions.relationships.divisionAddresses', ['addresses' => $division->divisionAddresses])
            </div>
        </div>
    </div>

@endsection
