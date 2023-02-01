<div class="m-3">
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-divisionUsers">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            Payment Status
                        </th>
                        <th>
                            Amount Paid
                        </th>

                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.mobile') }}
                        </th>


                        <th>
                            {{ trans('cruds.user.fields.avatar') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.district') }}
                        </th>
                        <th>
                            {{ "Check Payment" }}
                        </th>
                        @can('event_registration_update')
                        <th>
                            {{ "Action" }}
                        </th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($event->users as $key => $user)
                        @if($user->pivot->payment_status!=1)
                        <tr data-entry-id="{{ $user->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $key+1 }}
                            </td>
                            <td>
                                {{ $user->name ?? '' }}
                            </td>
                            <td>
                                @if($user->pivot->payment_status==1)
                                    Paid
                                    <br>
                                @else
                                    Unpaid
                                @endif
                            </td>
                            <td>
                                {!! $user->pivot->amount + $user->pivot->driver_amount + $user->pivot->spouse_amount!!}
                            </td>
                            <td>
                                {{ $user->email ?? '' }}
                            </td>
                            <td>
                                {{ $user->mobile ?? '' }}
                            </td>


                            <td>
                                @if($user->avatar)
                                    <a href="{{ $user->avatar->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $user->avatar->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>

                            <td>
                                {{ $user->district->name ?? '' }}
                            </td>

                            <td>
                                @if($user->pivot->payment_status==1)
                                    Paid
                                    <br>
                                @else

                                    @if(count($user->payment)>0)
                                        <table>
                                            @foreach($user->payment->groupBy('event_id') as $payments)
                                                @foreach($payments as $payment)

                                                    <tr>
                                                        <td>
                                                            @if($payment->status==2)
                                                                {{ "cancel" }}
                                                            @else
                                                                {{ "process" }}
                                                            @endif
                                                        </td>

                                                        <td>

                                                            <form method="POST" action="{{ route('admin.payment.paymentCheck') }}">
                                                                @csrf
                                                                <input type="hidden" name="trans_id" value="{{ $payment->trans_id }}">
                                                                <button class="btn btn-danger"  type="submit">
                                                                    Check
                                                                </button>
                                                            </form>

                                                        </td>
                                                    </tr>

                                                @endforeach
                                            @endforeach
                                        </table>
                                    @endif
                                @endif


                            </td>
                            @can('event_registration_update')
                                <td><a href="{{ route('admin.edit-registration-event',[$user->pivot->id,$event->id,$user->id,$event->name]) }}" class="btn btn-danger">Edit Event Registration</a></td>

                            @endcan



                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            });
            let table = $('.datatable-divisionUsers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
