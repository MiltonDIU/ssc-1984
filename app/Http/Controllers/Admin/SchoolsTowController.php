<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySchoolsTowRequest;
use App\Http\Requests\StoreSchoolsTowRequest;
use App\Http\Requests\UpdateSchoolsTowRequest;
use App\Models\SchoolsTow;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SchoolsTowController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('schools_tow_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SchoolsTow::query()->select(sprintf('%s.*', (new SchoolsTow())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'schools_tow_show';
                $editGate = 'schools_tow_edit';
                $deleteGate = 'schools_tow_delete';
                $crudRoutePart = 'schools-tows';

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
            $table->editColumn('district', function ($row) {
                return $row->district ? $row->district : '';
            });
            $table->editColumn('upazila', function ($row) {
                return $row->upazila ? $row->upazila : '';
            });
            $table->editColumn('eiin', function ($row) {
                return $row->eiin ? $row->eiin : '';
            });
            $table->editColumn('post_office', function ($row) {
                return $row->post_office ? $row->post_office : '';
            });
            $table->editColumn('mobile', function ($row) {
                return $row->mobile ? $row->mobile : '';
            });
            $table->editColumn('management', function ($row) {
                return $row->management ? $row->management : '';
            });
            $table->editColumn('mpo', function ($row) {
                return $row->mpo ? $row->mpo : '';
            });
            $table->editColumn('is_approve', function ($row) {
                return $row->is_approve ? SchoolsTow::IS_APPROVE_SELECT[$row->is_approve] : '';
            });
            $table->editColumn('is_active', function ($row) {
                return $row->is_active ? SchoolsTow::IS_ACTIVE_SELECT[$row->is_active] : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.schoolsTows.index');
    }

    public function create()
    {
        abort_if(Gate::denies('schools_tow_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.schoolsTows.create');
    }

    public function store(StoreSchoolsTowRequest $request)
    {
        $schoolsTow = SchoolsTow::create($request->all());

        return redirect()->route('admin.schools-tows.index');
    }

    public function edit(SchoolsTow $schoolsTow)
    {
        abort_if(Gate::denies('schools_tow_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.schoolsTows.edit', compact('schoolsTow'));
    }

    public function update(UpdateSchoolsTowRequest $request, SchoolsTow $schoolsTow)
    {
        $schoolsTow->update($request->all());

        return redirect()->route('admin.schools-tows.index');
    }

    public function show(SchoolsTow $schoolsTow)
    {
        abort_if(Gate::denies('schools_tow_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.schoolsTows.show', compact('schoolsTow'));
    }

    public function destroy(SchoolsTow $schoolsTow)
    {
        abort_if(Gate::denies('schools_tow_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $schoolsTow->delete();

        return back();
    }

    public function massDestroy(MassDestroySchoolsTowRequest $request)
    {
        SchoolsTow::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
