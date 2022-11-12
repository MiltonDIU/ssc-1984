@extends('member.layouts.master')
@section('content')
    <div class="event_box_main">
        <div class="event_box school_event_box">


        <div class="btns_group" style="padding-bottom: 20px">

        <div class="btn_wrap">
            <a href="{{ route('member.add-new-member') }}" class="group_btn group_btn_green">New Member <i class="bi bi-plus-circle"></i></a>
        </div>

    </div>

    <!-- ---------------------- Dashboard content end ---------------------- -->
        <div class="data_table">
            <table class="table table-borderless table-hover">
                <thead class="datalist_heading">
                <tr>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Location</th>
                    <th scope="col">School Name</th>
                    <th scope="col">Profile/Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <th scope="row">
                        <div class="data_profile_img">
                            @if($user->avatar)
                                <img src="{{ $user->avatar->getUrl('thumb') }}" alt="{{ $user->name }}">
                            @else
                                <img src="{{ url('assets/alumni/images/My profile.png') }}" alt="">
                            @endif
                        </div>
                    </th>
                    <td class="data_name " >{{ $user->name??"" }}</td>
                    <td>{{ $user->upazila->name??"" }}, {{ $user->district->name??"" }}</td>
                    <td>{{ $user->school->name??"" }}</td>
                    <td class="request_status request_sent">
                        <a href="{{ route('member.batch-mate.profile',[$user->id,$user->name]) }}">View Profile</a>
                        |
                        <a href="{{ route('member.edit-member',[$user->id]) }}">Edit <i class="bi bi-pencil-square"></i></a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->links('vendor.pagination.bootstrap-5')}}
        </div>
    <!-- ---------------------- Dashboard content end ---------------------- -->

        </div>
    </div>
@endsection


@push('style')
    <link rel="stylesheet" href="{{ url('assets/alumni/css/custom.css') }}">
@endpush
