@extends('layouts.admin')
@section('content')
    @can('residence_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.residences.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.residence.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Residence', 'route' => 'admin.residences.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.residence.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Residence">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.residence.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.residence.fields.area') }}
                    </th>
                    <th>
                        {{ trans('cruds.residence.fields.country') }}
                    </th>
                    <th>
                        {{ trans('cruds.residence.fields.state') }}
                    </th>
                    <th>
                        {{ trans('cruds.residence.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.residence.fields.user') }}
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
            @can('residence_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.residences.massDestroy') }}",
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
                ajax: "{{ route('admin.residences.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'area', name: 'area' },
                    { data: 'country_name', name: 'country.name' },
                    { data: 'state_name', name: 'state.name' },
                    { data: 'city_name', name: 'city.name' },
                    { data: 'user_name', name: 'user.name' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            };
            let table = $('.datatable-Residence').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>
@endsection
