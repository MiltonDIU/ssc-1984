@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.relatedData') }}
        </div>
        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">

            <li class="nav-item">
                <a class="nav-link active show" href="#list_of_payment" role="tab" data-toggle="tab">
                    {{ "List of Payment" }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active show" role="tabpanel" id="list_of_payment">
                @includeIf('admin.events.relationships.payment', ['users' => $event->users])
            </div>
        </div>


    </div>


@endsection
