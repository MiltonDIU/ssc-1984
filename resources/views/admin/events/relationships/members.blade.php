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
                            Are you coming with  Spouse?
                        </th>
                        <th>
                          Are you coming with  Driver?
                        </th>
                        <th>
                         Amount Paid
                        </th>

{{--                        <th>--}}
{{--                            {{ "Approved" }}--}}
{{--                        </th>--}}
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.mobile') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.blood_group') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.avatar') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.school') }}
                        </th>
{{--                        <th>--}}
{{--                            {{ trans('cruds.user.fields.profession') }}--}}
{{--                        </th>--}}
                        <th>
                            {{ trans('cruds.user.fields.district') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.upazila') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.id_ssc_bd') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.id_ssc_district') }}
                        </th>
{{--                        <th>--}}
{{--                            &nbsp;--}}
{{--                        </th>--}}
                    </tr>
                    </thead>
                    <tbody>




                    @foreach($event->users as $key => $user)

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
                                @if($user->pivot->spouse==1)
                                   Yes
                                    <br>
                                   {{ $user->spouse->name }}
                                    <br>
                                    @if($user->spouse->avatar)
                                            <img src="{{ $user->spouse->avatar->getUrl('thumb') }}">
                                    @endif
                                @else
                                    No
                                @endif
                            </td>
                            <td>
                                @if($user->pivot->driver==1)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                            <td>
                                    {!! $user->pivot->amount + $user->pivot->driver_amount + $user->pivot->spouse_amount!!}
                            </td>

{{--                            <td>--}}
{{--                                {{ $user->event->pivot ?? '' }}--}}
{{--                            </td>--}}
                            <td>
                                {{ $user->email ?? '' }}
                            </td>
                            <td>
                                {{ $user->mobile ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\User::GENDER_SELECT[$user->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $user->blood_group ?? '' }}
                            </td>
                            <td>
                                @if($user->avatar)
                                    <a href="{{ $user->avatar->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $user->avatar->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $user->school->name ?? '' }}
                            </td>
{{--                            <td>--}}
{{--                                @foreach($user->professions as $key => $item)--}}
{{--                                    <span class="badge badge-info">{{ $item->name }}</span>--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
                            <td>
                                {{ $user->district->name ?? '' }}
                            </td>
                            <td>
                                {{ $user->upazila->name ?? '' }}
                            </td>
                            <td>
                                @foreach($user->roles as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $user->id_ssc_bd ?? '' }}
                            </td>
                            <td>
                                {{ $user->id_ssc_district ?? '' }}
                            </td>
{{--                            <td>--}}
{{--                                @can('user_show')--}}
{{--                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.users.show', $user->id) }}">--}}
{{--                                        {{ trans('global.view') }}--}}
{{--                                    </a>--}}
{{--                                @endcan--}}

{{--                                @can('user_edit')--}}
{{--                                    <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $user->id) }}">--}}
{{--                                        {{ trans('global.edit') }}--}}
{{--                                    </a>--}}
{{--                                @endcan--}}

{{--                                @can('user_delete')--}}
{{--                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">--}}
{{--                                        <input type="hidden" name="_method" value="DELETE">--}}
{{--                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">--}}
{{--                                    </form>--}}
{{--                                @endcan--}}

{{--                            </td>--}}

                        </tr>
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
            @can('user_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.users.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }})
                            .done(function () { location.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton)
            @endcan

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
