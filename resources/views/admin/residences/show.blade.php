@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.residence.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.residences.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.residence.fields.id') }}
                        </th>
                        <td>
                            {{ $residence->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.residence.fields.area') }}
                        </th>
                        <td>
                            {{ $residence->area }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.residence.fields.country') }}
                        </th>
                        <td>
                            {{ $residence->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.residence.fields.state') }}
                        </th>
                        <td>
                            {{ $residence->state->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.residence.fields.city') }}
                        </th>
                        <td>
                            {{ $residence->city->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.residence.fields.user') }}
                        </th>
                        <td>
                            {{ $residence->user->name ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.residences.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
