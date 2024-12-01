<?php

namespace App\Http\Controllers;

use App\Models\AppointmentPayment;
use Illuminate\Http\Request;
use App\Enums\Models\Appointment\PaymentStatus;
use App\Enums\Models\Appointment\StatusType;

class AppointmentPaymentController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppointmentPayment  $appointmentPayment
     * @return \Illuminate\Http\Response
     */
    public function show(AppointmentPayment $appointmentPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppointmentPayment  $appointmentPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppointmentPayment $appointmentPayment)
    {
        $validated = $request->validate();

        if($validated['status'] == PaymentStatus::PAID->value) {
            $appointmentPayment->status = StatusType::CONFIRMED->value;
            $appointmentPayment->save();
        }

        $time = strtotime($appointmentPayment->created_at);

        if ($time < now()->subMinutes(15)->timestamp) {
            $appointmentPayment->status = StatusType::CANCELLED->value;
            $appointmentPayment->appointment->status = StatusType::CANCELLED->value;
            $appointmentPayment->appointment->save();
            $appointmentPayment->save();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppointmentPayment  $appointmentPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppointmentPayment $appointmentPayment)
    {
        //
    }
}
