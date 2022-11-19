@extends('layouts.admin')
@section('content')
    @can('school_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.schools.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.school.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.school.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-School">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.school.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.division') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.district') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.upazila') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.eiin') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.mobile') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.management') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.mpo') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.post_office') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.is_approve') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.is_active') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                </thead>
            </table>
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('school_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.schools.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                        return entry.id
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

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.schools.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'division_name', name: 'division.name' },
                    { data: 'district_name', name: 'district.name' },
                    { data: 'upazila_name', name: 'upazila.name' },
                    { data: 'eiin', name: 'eiin' },
                    { data: 'mobile', name: 'mobile' },
                    { data: 'management', name: 'management' },
                    { data: 'mpo', name: 'mpo' },
                    { data: 'post_office', name: 'post_office' },
                    { data: 'address', name: 'address' },
                    { data: 'is_approve', name: 'is_approve' },
                    { data: 'is_active', name: 'is_active' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            };
            let table = $('.datatable-School').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>
@endsection
