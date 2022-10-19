<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUpazilaRequest;
use App\Http\Requests\StoreUpazilaRequest;
use App\Http\Requests\UpdateUpazilaRequest;
use App\Models\District;
use App\Models\Upazila;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UpazilaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('upazila_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Upazila::with(['district'])->select(sprintf('%s.*', (new Upazila())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'upazila_show';
                $editGate = 'upazila_edit';
                $deleteGate = 'upazila_delete';
                $crudRoutePart = 'upazilas';

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
            $table->addColumn('district_name', function ($row) {
                return $row->district ? $row->district->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('is_active', function ($row) {
                return $row->is_active ? Upazila::IS_ACTIVE_SELECT[$row->is_active] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'district']);

            return $table->make(true);
        }

        return view('admin.upazilas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('upazila_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.upazilas.create', compact('districts'));
    }

    public function store(StoreUpazilaRequest $request)
    {
        $upazila = Upazila::create($request->all());

        return redirect()->route('admin.upazilas.index');
    }

    public function edit(Upazila $upazila)
    {
        abort_if(Gate::denies('upazila_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazila->load('district');

        return view('admin.upazilas.edit', compact('districts', 'upazila'));
    }

    public function update(UpdateUpazilaRequest $request, Upazila $upazila)
    {
        $upazila->update($request->all());

        return redirect()->route('admin.upazilas.index');
    }

    public function show(Upazila $upazila)
    {
        abort_if(Gate::denies('upazila_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $upazila->load('district', 'upazilaSchools', 'upazilaAddresses', 'upazilaUsers');

        return view('admin.upazilas.show', compact('upazila'));
    }

    public function destroy(Upazila $upazila)
    {
        abort_if(Gate::denies('upazila_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $upazila->delete();

        return back();
    }

    public function massDestroy(MassDestroyUpazilaRequest $request)
    {
        Upazila::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    //return district wise upazila
    public function get_by_district(Request $request)
    {
        abort_unless(\Gate::allows('district_access'), 401);

        if (!$request->district_id) {
            $html = '<option value="">'.trans('global.pleaseSelect').'</option>';
        } else {
            $html = '';
            $upazilas = Upazila::where('district_id', $request->district_id)->get();
            foreach ($upazilas as $city) {
                $html .= '<option value="'.$city->id.'">'.$city->name.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }
}
