<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\StoreRequest;
use App\Http\Requests\Service\IndexRequest;
use App\Http\Requests\Service\UpdateRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Resources\ServiceResource;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $services = Service::with('clinic')->paginate($request->input('per_page', 10));

        return ServiceResource::collection($services);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $service = Service::create($request->validated());

        return ServiceResource::make($service);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $service->load('department');
        
        return ServiceResource::make($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Service $service)
    {
        $service->update($request->validated());

        return ServiceResource::make($service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
    }

    public function getByDepartmentId($departmentId)
    {
        $services = Service::where('department_id', $departmentId)->get();

        return ServiceResource::collection($services);
    }
}
