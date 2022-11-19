<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpazilaRequest;
use App\Http\Requests\UpdateUpazilaRequest;
use App\Http\Resources\Admin\UpazilaResource;
use App\Models\Upazila;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpazilaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('upazila_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UpazilaResource(Upazila::with(['district'])->get());
    }

    public function store(StoreUpazilaRequest $request)
    {
        $upazila = Upazila::create($request->all());

        return (new UpazilaResource($upazila))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Upazila $upazila)
    {
        abort_if(Gate::denies('upazila_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UpazilaResource($upazila->load(['district']));
    }

    public function update(UpdateUpazilaRequest $request, Upazila $upazila)
    {
        $upazila->update($request->all());

        return (new UpazilaResource($upazila))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Upazila $upazila)
    {
        abort_if(Gate::denies('upazila_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $upazila->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
