<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfessionRequest;
use App\Http\Requests\UpdateProfessionRequest;
use App\Http\Resources\Admin\ProfessionResource;
use App\Models\Profession;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfessionsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('profession_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProfessionResource(Profession::all());
    }

    public function store(StoreProfessionRequest $request)
    {
        $profession = Profession::create($request->all());

        return (new ProfessionResource($profession))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Profession $profession)
    {
        abort_if(Gate::denies('profession_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProfessionResource($profession);
    }

    public function update(UpdateProfessionRequest $request, Profession $profession)
    {
        $profession->update($request->all());

        return (new ProfessionResource($profession))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Profession $profession)
    {
        abort_if(Gate::denies('profession_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $profession->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
