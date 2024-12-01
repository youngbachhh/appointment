<?php

namespace App\Http\Controllers;

use App\Http\Requests\Department\IndexRequest;
use App\Http\Requests\Department\StoreRequest;
use App\Http\Requests\Department\UpdateRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $departments = Department::with('registration')->paginate($request->input('per_page', 10));

        return DepartmentResource::collection($departments);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $department = Department::create($request->validated());

        return DepartmentResource::make($department);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return DepartmentResource::make($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Department $department)
    {
        $department->update($request->validated());

        return DepartmentResource::make($department);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
    }

    public function getByRegistrationId($registrationId)
    {
        $departments = Department::where('registration_id', $registrationId)->get();

        return DepartmentResource::collection($departments);
    }
}
