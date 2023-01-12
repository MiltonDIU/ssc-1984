<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyResidenceRequest;
use App\Http\Requests\StoreResidenceRequest;
use App\Http\Requests\UpdateResidenceRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Residence;
use App\Models\State;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ResidencesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('residence_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Residence::with(['country', 'state', 'city', 'user'])->select(sprintf('%s.*', (new Residence())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'residence_show';
                $editGate = 'residence_edit';
                $deleteGate = 'residence_delete';
                $crudRoutePart = 'residences';

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
            $table->editColumn('area', function ($row) {
                return $row->area ? $row->area : '';
            });
            $table->addColumn('country_name', function ($row) {
                return $row->country ? $row->country->name : '';
            });

            $table->addColumn('state_name', function ($row) {
                return $row->state ? $row->state->name : '';
            });

            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'country', 'state', 'city', 'user']);

            return $table->make(true);
        }

        return view('admin.residences.index');
    }

    public function create()
    {
        abort_if(Gate::denies('residence_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.residences.create', compact('cities', 'countries', 'states', 'users'));
    }

    public function store(StoreResidenceRequest $request)
    {
        $residence = Residence::create($request->all());

        return redirect()->route('admin.residences.index');
    }

    public function edit(Residence $residence)
    {
        abort_if(Gate::denies('residence_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $residence->load('country', 'state', 'city', 'user');

        return view('admin.residences.edit', compact('cities', 'countries', 'residence', 'states', 'users'));
    }

    public function update(UpdateResidenceRequest $request, Residence $residence)
    {
        $residence->update($request->all());

        return redirect()->route('admin.residences.index');
    }

    public function show(Residence $residence)
    {
        abort_if(Gate::denies('residence_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $residence->load('country', 'state', 'city', 'user');

        return view('admin.residences.show', compact('residence'));
    }

    public function destroy(Residence $residence)
    {
        abort_if(Gate::denies('residence_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $residence->delete();

        return back();
    }

    public function massDestroy(MassDestroyResidenceRequest $request)
    {
        Residence::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }


    //return district wise upazila
    public function getByState(Request $request)
    {
        if (!$request->country_id) {
            $html = '<option value="">'.trans('global.pleaseSelect').'</option>';
        } else {
            $html = '';
            $states = State::where('country_id', $request->country_id)->get();
            $html .= '<option value="">Please select District/State</option>';
            foreach ($states as $state) {

                $html .= '<option value="'.$state->id.'">'.$state->name.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }


    //return district wise upazila
    public function getByCity(Request $request)
    {
        if (!$request->state_id) {
            $html = '<option value="">'.trans('global.pleaseSelect').'</option>';
        } else {
            $html = '';
            $cities = City::where('state_id', $request->state_id)->get();
            $html .= '<option value="">Please select Upazila/City</option>';
            foreach ($cities as $city) {

                $html .= '<option value="'.$city->id.'">'.$city->name.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }
}
