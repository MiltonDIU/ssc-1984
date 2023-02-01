@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.spouse.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.spouses.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.spouse.fields.id') }}
                        </th>
                        <td>
                            {{ $spouse->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.spouse.fields.name') }}
                        </th>
                        <td>
                            {{ $spouse->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.spouse.fields.avatar') }}
                        </th>
                        <td>
                            @if($spouse->avatar)
                                <a href="{{ $spouse->avatar->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $spouse->avatar->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.spouse.fields.user') }}
                        </th>
                        <td>
                            {{ $spouse->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.spouse.fields.event') }}
                        </th>
                        <td>
                            {{ $spouse->event->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.spouse.fields.created_by') }}
                        </th>
                        <td>
                            {{ $spouse->created_by->name ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.spouses.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
