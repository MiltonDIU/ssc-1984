<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCountryRequest;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CountriesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('country_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Country::query()->select(sprintf('%s.*', (new Country())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'country_show';
                $editGate = 'country_edit';
                $deleteGate = 'country_delete';
                $crudRoutePart = 'countries';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('iso3', function ($row) {
                return $row->iso3 ? $row->iso3 : '';
            });
            $table->editColumn('numeric_code', function ($row) {
                return $row->numeric_code ? $row->numeric_code : '';
            });
            $table->editColumn('iso2', function ($row) {
                return $row->iso2 ? $row->iso2 : '';
            });
            $table->editColumn('phonecode', function ($row) {
                return $row->phonecode ? $row->phonecode : '';
            });
            $table->editColumn('capital', function ($row) {
                return $row->capital ? $row->capital : '';
            });
            $table->editColumn('currency', function ($row) {
                return $row->currency ? $row->currency : '';
            });
            $table->editColumn('currency_name', function ($row) {
                return $row->currency_name ? $row->currency_name : '';
            });
            $table->editColumn('currency_symbol', function ($row) {
                return $row->currency_symbol ? $row->currency_symbol : '';
            });
            $table->editColumn('tld', function ($row) {
                return $row->tld ? $row->tld : '';
            });
            $table->editColumn('native', function ($row) {
                return $row->native ? $row->native : '';
            });
            $table->editColumn('region', function ($row) {
                return $row->region ? $row->region : '';
            });
            $table->editColumn('subregion', function ($row) {
                return $row->subregion ? $row->subregion : '';
            });
            $table->editColumn('timezones', function ($row) {
                return $row->timezones ? $row->timezones : '';
            });
            $table->editColumn('translations', function ($row) {
                return $row->translations ? $row->translations : '';
            });
            $table->editColumn('latitude', function ($row) {
                return $row->latitude ? $row->latitude : '';
            });
            $table->editColumn('longitude', function ($row) {
                return $row->longitude ? $row->longitude : '';
            });
            $table->editColumn('emoji', function ($row) {
                return $row->emoji ? $row->emoji : '';
            });
            $table->editColumn('emoji_u', function ($row) {
                return $row->emoji_u ? $row->emoji_u : '';
            });
            $table->editColumn('wiki_data', function ($row) {
                return $row->wiki_data ? $row->wiki_data : '';
            });
            $table->editColumn('flag', function ($row) {
                return $row->flag ? Country::FLAG_SELECT[$row->flag] : '';
            });
            $table->editColumn('is_active', function ($row) {
                return $row->is_active ? Country::IS_ACTIVE_SELECT[$row->is_active] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.countries.index');
    }

    public function create()
    {
        abort_if(Gate::denies('country_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.countries.create');
    }

    public function store(StoreCountryRequest $request)
    {
        $country = Country::create($request->all());

        return redirect()->route('admin.countries.index');
    }

    public function edit(Country $country)
    {
        abort_if(Gate::denies('country_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.countries.edit', compact('country'));
    }

    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->update($request->all());

        return redirect()->route('admin.countries.index');
    }

    public function show(Country $country)
    {
        abort_if(Gate::denies('country_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $country->load('countryStates');

        return view('admin.countries.show', compact('country'));
    }

    public function destroy(Country $country)
    {
        abort_if(Gate::denies('country_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $country->delete();

        return back();
    }

    public function massDestroy(MassDestroyCountryRequest $request)
    {
        Country::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
