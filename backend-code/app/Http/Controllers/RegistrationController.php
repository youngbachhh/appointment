<?php

namespace App\Http\Controllers;

use App\Http\Requests\Registration\IndexRequest;
use App\Http\Requests\Registration\StoreRequest;
use App\Http\Requests\Registration\UpdateRequest;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Resources\RegistrationResource;
use App\Models\Clinic;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $registrations = Registration::with('clinic')->paginate($request->input('per_page', 10));

        return RegistrationResource::collection($registrations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $registration = Registration::create($request->validated());

        return RegistrationResource::make($registration);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    {
        return RegistrationResource::make($registration);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Registration $registration)
    {
        $registration->update($request->validated());

        return RegistrationResource::make($registration);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registration $registration)
    {
        $registration->delete();
    }

    public function getByClinicId($clinicId)
    {
        $registrations = Registration::where('clinic_id', $clinicId)->get();
        
        return RegistrationResource::collection($registrations);
    }
}
