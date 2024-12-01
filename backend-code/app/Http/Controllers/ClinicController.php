<?php

namespace App\Http\Controllers;

use App\Http\Requests\Clinic\IndexRequest;
use App\Http\Requests\Clinic\StoreRequest;
use App\Http\Requests\Clinic\UpdateRequest;
use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Http\Resources\ClinicResource;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $clinics = Clinic::paginate($request->input('per_page', 10));

        return ClinicResource::collection($clinics);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $clinic = Clinic::create($request->validated());

        return ClinicResource::make($clinic);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic)
    {
        return ClinicResource::make($clinic);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Clinic $clinic)
    {
        $clinic->update($request->validated());

        return ClinicResource::make($clinic);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic)
    {
        $clinic->delete();
    }
}
