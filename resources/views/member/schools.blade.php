@extends('member.layouts.master')

@section('content')
    <div class="event_box_main">
        <div class="event_box school_event_box">

    <div class="data_table">
        <table class="table table-borderless table-hover">
            <thead class="datalist_heading">
            <tr>
                <th scope="col">School Name</th>
                <th scope="col">Location</th>
                <th scope="col">Number of students</th>
                <th scope="col">View</th>
            </tr>
            </thead>

            <tbody>

@foreach($schools as $school)

            <tr>
                <td class="data_name">{{ $school->name??"" }}</td>
                <td>{{ $school->upazila->name??"" }}, {{ $school->district->name??"" }} , {{ $school->division->name??"" }}</td>
                <td>{{ count($school->schoolUsers) }}</td>
                <td class="view_profile">
                    <a href="{{ route('member.schoolProfile',[$school->id,$school->name]) }}">View School</a>
                </td>
            </tr>

@endforeach

            </tbody>
        </table>

        {{ $schools->links('vendor.pagination.bootstrap-5')}}
    </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent

@endsection

@push('style')
    <link rel="stylesheet" href="{{ url('assets/alumni/css/custom.css') }}">
@endpush
