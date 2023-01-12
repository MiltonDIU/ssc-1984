<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCityRequest;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use DB;
class CitiesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('city_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = City::with(['country', 'state'])->select(sprintf('%s.*', (new City())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'city_show';
                $editGate = 'city_edit';
                $deleteGate = 'city_delete';
                $crudRoutePart = 'cities';

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
            $table->addColumn('country_name', function ($row) {
                return $row->country ? $row->country->id : '';
            });

            $table->addColumn('state_name', function ($row) {
                return $row->state ? $row->state->id-64 : '';
            });

            $table->editColumn('state_code', function ($row) {
                return $row->state_code ? $row->state_code : '';
            });
            $table->editColumn('flag', function ($row) {
                return $row->flag ? $row->flag : '';
            });
            $table->editColumn('is_active', function ($row) {
                return $row->is_active ? $row->is_active : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'country', 'state']);

            return $table->make(true);
        }

        return view('admin.cities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('city_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cities.create', compact('countries', 'states'));
    }

    public function store(StoreCityRequest $request)
    {
        $city = City::create($request->all());

        return redirect()->route('admin.cities.index');
    }

    public function edit(City $city)
    {
        abort_if(Gate::denies('city_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $city->load('country', 'state');

        return view('admin.cities.edit', compact('city', 'countries', 'states'));
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        $city->update($request->all());

        return redirect()->route('admin.cities.index');
    }

    public function show(City $city)
    {
        abort_if(Gate::denies('city_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $city->load('country', 'state');

        return view('admin.cities.show', compact('city'));
    }

    public function destroy(City $city)
    {
        abort_if(Gate::denies('city_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $city->delete();

        return back();
    }

    public function massDestroy(MassDestroyCityRequest $request)
    {
        City::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function cityMigrate(){
        $countries = Country::all();
        foreach ($countries as $country){
            if (count($country->state)>0){
                foreach ($country->state as $state){
                    $newStateData['name'] = $state->name;
                    $newStateData['country_id'] = $state->country_id;
                    $newStateData['country_code'] = $state->country_code;
                    $newStateData['flag'] = $state->flag;
                    $newStateData['is_active'] = 1;
                    $newState = State::create($newStateData);
                   if (count($state->city)>0){
                       foreach ($state->city as $city){
                           $newCityData['name'] = $city->name;
                           $newCityData['country_id'] = $city->country_id;
                           $newCityData['state_id'] = $newState->id;
                           $newCityData['state_code'] = $city->state_code;
                           $newCityData['flag'] = $city->flag;
                           $newCityData['is_active'] = 1;
                            City::create($newCityData);
//                            dd('test');
                            $city->delete();
                       }
//                       echo count($state->city);
//                       echo "<br>";
                   }
                $state->delete();
                }
//                echo count($country->state);
//                echo "<br>";
            }
            echo "Done--$country->name<br>";
        }
    }

    public function duplicateDelete(){
//        $duplicate_states = DB::select(DB::raw("
//  SELECT country_id, country_code, name, COUNT(*)
//  FROM states
//  GROUP BY country_id, country_code, name
//  HAVING COUNT(*) > 1;
//"));
        $duplicate_states = DB::table('states')
            ->select('id','country_id', 'country_code', 'name', DB::raw('COUNT(*)'))
            ->where('deleted_at',null)
            ->groupBy('id','country_id', 'country_code', 'name')
            ->get();

        foreach ($duplicate_states as $key=>$row){

            $cities = City::where('state_id',$row->id)->get();
            if (count($cities)==0){
                echo $row->name."<br>";
            }



//            $states = State::where('name',$row->name)->get();
//
//            foreach ($states as $k=>$state){
//               // echo "<br>$state->name";
//                if ($k!=0){
////                    echo "<br>2nd parameter state";
//                    $cities = City::where('state_id',$state->id)->get();
//                    if ($cities->isEmpty()) {
//                        echo "The object is empty";
//                    } else {
//                        if (count($cities)>0){
//                            echo count($cities)."<br>";
////                            foreach ($cities as $city){
//////                                $city->delete();
////                            }
//                        }
//                    }
////                    $state->delete();
//                }else{
////                    echo "<br>1st parameter state";
//                }
//
//            }

        }
    echo "<br>end duplicate list";
    }
}
