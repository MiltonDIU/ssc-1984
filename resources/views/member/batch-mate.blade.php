@extends('member.layouts.master')
@section('top_content')
    <div class="dashboard_search">
        <input type="search" placeholder="Search">
        <i class="bi bi-search"></i>
    </div>
@endsection
@section('content')

    <!-- ---------------------- Dashboard content end ---------------------- -->


        <div class="data_table">
            <table class="table table-borderless table-hover">
                <thead class="datalist_heading">
                <tr>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Location</th>
                    <th scope="col">School Name</th>
                    <th scope="col">Profile</th>
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
                    <td class="request_status request_sent"><a href="{{ route('member.batch-mate.profile',[$user->id,$user->name]) }}">View Profile</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->links('vendor.pagination.bootstrap-5')}}
        </div>
    <!-- ---------------------- Dashboard content end ---------------------- -->
@endsection

