@extends('layouts.admin')
@section('content')
    @can('schools_tow_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.schools-tows.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.schoolsTow.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'SchoolsTow', 'route' => 'admin.schools-tows.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.schoolsTow.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-SchoolsTow">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.schoolsTow.fields.id') }}
                    </th>

                    <th>
                        {{ trans('cruds.schoolsTow.fields.district') }}
                    </th>
                    <th>
                        {{ trans('cruds.schoolsTow.fields.upazila') }}
                    </th>
                    <th>
                        {{ trans('cruds.schoolsTow.fields.eiin') }}
                    </th>
                    <th>
                        {{ trans('cruds.schoolsTow.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.schoolsTow.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.schoolsTow.fields.post_office') }}
                    </th>
                    <th>
                        {{ trans('cruds.schoolsTow.fields.mobile') }}
                    </th>
                    <th>
                        {{ trans('cruds.schoolsTow.fields.management') }}
                    </th>
                    <th>
                        {{ trans('cruds.schoolsTow.fields.mpo') }}
                    </th>


                    <th>
                        {{ trans('cruds.schoolsTow.fields.is_approve') }}
                    </th>
                    <th>
                        {{ trans('cruds.schoolsTow.fields.is_active') }}
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
            @can('schools_tow_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.schools-tows.massDestroy') }}",
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
                ajax: "{{ route('admin.schools-tows.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },

                    { data: 'district', name: 'district' },
                    { data: 'upazila', name: 'upazila' },
                    { data: 'eiin', name: 'eiin' },
                    { data: 'name', name: 'name' },
                    { data: 'address', name: 'address' },
                    { data: 'post_office', name: 'post_office' },
                    { data: 'mobile', name: 'mobile' },
                    { data: 'management', name: 'management' },
                    { data: 'mpo', name: 'mpo' },
                    { data: 'is_approve', name: 'is_approve' },
                    { data: 'is_active', name: 'is_active' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 5000,
                paging: false
            };
            let table = $('.datatable-SchoolsTow').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>
@endsection
