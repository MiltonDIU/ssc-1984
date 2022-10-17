<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProfessionRequest;
use App\Http\Requests\StoreProfessionRequest;
use App\Http\Requests\UpdateProfessionRequest;
use App\Models\Profession;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProfessionsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('profession_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Profession::query()->select(sprintf('%s.*', (new Profession())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'profession_show';
                $editGate = 'profession_edit';
                $deleteGate = 'profession_delete';
                $crudRoutePart = 'professions';

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
            $table->editColumn('is_active', function ($row) {
                return $row->is_active ? Profession::IS_ACTIVE_SELECT[$row->is_active] : '';
            });
            $table->editColumn('profession_parrent', function ($row) {
                if ($row->profession_parrent>0){
                    $profession = Profession::find($row->profession_parrent);
                }
                return $row->profession_parrent ? $profession->name : $row->name;
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.professions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('profession_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.professions.create');
    }

    public function store(StoreProfessionRequest $request)
    {
        $profession = Profession::create($request->all());

        return redirect()->route('admin.professions.index');
    }

    public function edit(Profession $profession)
    {
        abort_if(Gate::denies('profession_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.professions.edit', compact('profession'));
    }

    public function update(UpdateProfessionRequest $request, Profession $profession)
    {
        $profession->update($request->all());

        return redirect()->route('admin.professions.index');
    }

    public function show(Profession $profession)
    {
        abort_if(Gate::denies('profession_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $profession->load('professionUsers');

        return view('admin.professions.show', compact('profession'));
    }

    public function destroy(Profession $profession)
    {
        abort_if(Gate::denies('profession_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $profession->delete();

        return back();
    }

    public function massDestroy(MassDestroyProfessionRequest $request)
    {
        Profession::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
