@extends('member.layouts.master')
@section('content')
    @if(count($events)>0)
        @include('member.section.event')
    @endif
@endsection
@section('scripts')
    @parent

@endsection

