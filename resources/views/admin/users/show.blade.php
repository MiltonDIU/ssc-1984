@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.user.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr style="background: #6f42c1">
                        <td colspan="2" style="color: white; font-weight: bolder"> Personal Information</td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id_ssc_bd') }}
                        </th>
                        <td>
                            {{ $user->id_ssc_bd }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id_ssc_district') }}
                        </th>
                        <td>
                            {{ $user->id_ssc_district }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.avatar') }}
                        </th>
                        <td>
                            @if($user->avatar)
                                <a href="{{ $user->avatar->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $user->avatar->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.mobile') }}
                        </th>
                        <td>
                            {{ $user->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.telephone_number') }}
                        </th>
                        <td>
                            {{ $user->telephone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\User::GENDER_SELECT[$user->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $user->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.blood_group') }}
                        </th>
                        <td>
                            {{ $user->blood_group }}
                        </td>
                    </tr>
                    <tr style="background: #6f42c1">
                        <td colspan="2" style="color: white; font-weight: bolder"> Reference By</td>
                    </tr>

                    <tr>
                        <th>
                            {{ "Name and Represent District" }}
                        </th>
                        <td>
                            {{ $user->created_by->name??"" }}, {{ $user->created_by?$user->created_by->district?$user->created_by->district->name:"":"" }}
                        </td>
                    </tr>


                    <tr style="background: #6f42c1">
                        <td colspan="2" style="color: white; font-weight: bolder"> School Information</td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.school') }}
                        </th>
                        <td>
                            {{ $user->school->name ?? '' }} -- {{ $user->school->upazila->name ?? '' }}, {{ $user->school->district->name ?? '' }}, {{ $user->school->division->name ?? '' }}
                        </td>
                    </tr>
                    <tr style="background: #6f42c1">
                        <td colspan="2" style="color: white; font-weight: bolder"> Professions Information</td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.profession') }}
                        </th>
                        <td>
                            @foreach($user->professions as $key => $profession)
                                <span class="label label-info">{{ $profession->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr style="background: #6f42c1">
                        <td colspan="2" style="color: white; font-weight: bolder"> Represent Information</td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.division') }}
                        </th>
                        <td>
                            {{ $user->division->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.district') }}
                        </th>
                        <td>
                            {{ $user->district->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.upazila') }}
                        </th>
                        <td>
                            {{ $user->upazila->name ?? '' }}
                        </td>
                    </tr>
                    <tr style="background: #6f42c1">
                        <td colspan="2" style="color: white; font-weight: bolder"> Member Present Address</td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.residence.fields.country') }}
                        </th>
                        <td>
                            {{ $user->residence->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.residence.fields.state') }}
                        </th>
                        <td>
                            {{ $user->residence->state->name ?? '' }},
                            {{ $user->residence->state->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.residence.fields.city') }}
                        </th>
                        <td>
                            {{ $user->residence->city->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.residence.fields.area') }}
                        </th>
                        <td>
                            {{ $user->residence->area ?? '' }}
                        </td>
                    </tr>

                    <tr style="background: #6f42c1">
                        <td colspan="2" style="color: white; font-weight: bolder"> User Roll</td>
                    </tr>




                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>

                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
