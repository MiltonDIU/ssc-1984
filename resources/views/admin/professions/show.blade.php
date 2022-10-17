@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.profession.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.professions.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.profession.fields.id') }}
                        </th>
                        <td>
                            {{ $profession->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profession.fields.name') }}
                        </th>
                        <td>
                            {{ $profession->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profession.fields.slug') }}
                        </th>
                        <td>
                            {{ $profession->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profession.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Profession::IS_ACTIVE_SELECT[$profession->is_active] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profession.fields.profession_parrent') }}
                        </th>
                        <td>
                            {{ $profession->profession_parrent }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.professions.index') }}">
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
                <a class="nav-link" href="#profession_users" role="tab" data-toggle="tab">
                    {{ trans('cruds.user.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="profession_users">
                @includeIf('admin.professions.relationships.professionUsers', ['users' => $profession->professionUsers])
            </div>
        </div>
    </div>

@endsection
