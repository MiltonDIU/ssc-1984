<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDivisionRequest;
use App\Http\Requests\UpdateDivisionRequest;
use App\Http\Resources\Admin\DivisionResource;
use App\Models\Division;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DivisionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('division_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DivisionResource(Division::all());
    }

    public function store(StoreDivisionRequest $request)
    {
        $division = Division::create($request->all());

        return (new DivisionResource($division))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Division $division)
    {
        abort_if(Gate::denies('division_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DivisionResource($division);
    }

    public function update(UpdateDivisionRequest $request, Division $division)
    {
        $division->update($request->all());

        return (new DivisionResource($division))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Division $division)
    {
        abort_if(Gate::denies('division_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $division->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
