<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkingHour\StoreRequest;
use App\Http\Requests\WorkingHour\UpdateRequest;
use App\Models\WorkingHour;
use Illuminate\Http\Request;
use App\Services\WorkingHourService;

class WorkingHourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $validate = $request->validated();
        $workingHour = WorkingHour::create($validate);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function show(WorkingHour $workingHour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, WorkingHour $workingHour)
    {
        $validate = $request->validated();
        $workingHourService = app(WorkingHourService::class);
        $workingHourService->updateWorkingHours($request, $workingHour->doctor_id);

        $workingHour->update($validate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkingHour  $workingHour
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkingHour $workingHour)
    {
        //
    }
}
