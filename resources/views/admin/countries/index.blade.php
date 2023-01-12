@extends('layouts.admin')
@section('content')
    @can('country_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.countries.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.country.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Country', 'route' => 'admin.countries.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.country.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Country">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.country.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.iso3') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.numeric_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.iso2') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.phonecode') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.capital') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.currency') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.currency_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.currency_symbol') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.tld') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.native') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.region') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.subregion') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.timezones') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.translations') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.latitude') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.longitude') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.emoji') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.emoji_u') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.wiki_data') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.flag') }}
                    </th>
                    <th>
                        {{ trans('cruds.country.fields.is_active') }}
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
            @can('country_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.countries.massDestroy') }}",
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
                ajax: "{{ route('admin.countries.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'iso3', name: 'iso3' },
                    { data: 'numeric_code', name: 'numeric_code' },
                    { data: 'iso2', name: 'iso2' },
                    { data: 'phonecode', name: 'phonecode' },
                    { data: 'capital', name: 'capital' },
                    { data: 'currency', name: 'currency' },
                    { data: 'currency_name', name: 'currency_name' },
                    { data: 'currency_symbol', name: 'currency_symbol' },
                    { data: 'tld', name: 'tld' },
                    { data: 'native', name: 'native' },
                    { data: 'region', name: 'region' },
                    { data: 'subregion', name: 'subregion' },
                    { data: 'timezones', name: 'timezones' },
                    { data: 'translations', name: 'translations' },
                    { data: 'latitude', name: 'latitude' },
                    { data: 'longitude', name: 'longitude' },
                    { data: 'emoji', name: 'emoji' },
                    { data: 'emoji_u', name: 'emoji_u' },
                    { data: 'wiki_data', name: 'wiki_data' },
                    { data: 'flag', name: 'flag' },
                    { data: 'is_active', name: 'is_active' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            };
            let table = $('.datatable-Country').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>
@endsection
