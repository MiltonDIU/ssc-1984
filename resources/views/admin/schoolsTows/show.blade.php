@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.schoolsTow.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.schools-tows.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.schoolsTow.fields.id') }}
                        </th>
                        <td>
                            {{ $schoolsTow->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.schoolsTow.fields.name') }}
                        </th>
                        <td>
                            {{ $schoolsTow->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.schoolsTow.fields.slug') }}
                        </th>
                        <td>
                            {{ $schoolsTow->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.schoolsTow.fields.district') }}
                        </th>
                        <td>
                            {{ $schoolsTow->district }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.schoolsTow.fields.upazila') }}
                        </th>
                        <td>
                            {{ $schoolsTow->upazila }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.schoolsTow.fields.eiin') }}
                        </th>
                        <td>
                            {{ $schoolsTow->eiin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.schoolsTow.fields.mobile') }}
                        </th>
                        <td>
                            {{ $schoolsTow->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.schoolsTow.fields.management') }}
                        </th>
                        <td>
                            {{ $schoolsTow->management }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.schoolsTow.fields.mpo') }}
                        </th>
                        <td>
                            {{ $schoolsTow->mpo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.schoolsTow.fields.post_office') }}
                        </th>
                        <td>
                            {{ $schoolsTow->post_office }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.schoolsTow.fields.address') }}
                        </th>
                        <td>
                            {{ $schoolsTow->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.schoolsTow.fields.is_approve') }}
                        </th>
                        <td>
                            {{ App\Models\SchoolsTow::IS_APPROVE_SELECT[$schoolsTow->is_approve] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.schoolsTow.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\SchoolsTow::IS_ACTIVE_SELECT[$schoolsTow->is_active] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.schools-tows.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
