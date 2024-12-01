<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointment\IndexRequest;
use App\Http\Requests\Appointment\StoreRequest;
use App\Http\Requests\Appointment\UpdateRequest;
use App\Http\Resources\AppointmentResource;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Mail\AppointmentCreated;
use Illuminate\Support\Facades\Mail;
use App\Enums\Models\Appointment\PaymentStatus;
use App\Enums\Models\Appointment\StatusType;
use App\Models\TimeSlot;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $appointments = Appointment::with('user', 'doctor', 'clinic', 'registration', 'department')->paginate($request->input('per_page', 10));

        return AppointmentResource::collection($appointments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $appointment = Appointment::create($request->validated());

        $appointmentPayment = $appointment->payment()->create([
            'amount' => $appointment->amount,
            'status' => PaymentStatus::PENDING->value,
        ]);

        if ($appointment) {
            Mail::to($appointment->user->email)->send(new AppointmentCreated($appointment));
        }

        return AppointmentResource::make($appointment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        return AppointmentResource::make($appointment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Appointment $appointment)
    {
        $validated = $request->validated();
        $timeSlot = [
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'date' => $validated['date'],
        ];


        if ($validated['status'] == StatusType::CANCELLED->value 
            && now()->format('H') < 22
            && now()->format('d') >= $timeSlot['date']->format('d')
        ) {
            $timeSlot = TimeSlot::where('date', $timeSlot['date'])
                ->where('start_time', $timeSlot['start_time'])
                ->where('end_time', $timeSlot['end_time'])
                ->lockForUpdate()->first();

            $appointment->payment->status = PaymentStatus::CANCELLED->value;
            $appointment->payment->save();
            
            $timeSlot->increment('remaining_slots');

            $appointment->update($validated());
        }

        if($validated['status'] == StatusType::PENDING->value) {
            $appointment->payment->status = PaymentStatus::PENDING->value;
            $appointment->payment->save();

            $appointment->update($validated());
        }

        if($validated['status'] == StatusType::CONFIRMED->value) {
            DB::transaction(function () use ($timeSlot, $validated, $appointment) {
                $timeSlot = TimeSlot::where('date', $timeSlot['date'])
                    ->where('start_time', $timeSlot['start_time'])
                    ->where('end_time', $timeSlot['end_time'])
                    ->lockForUpdate()->first();
    
                if ($timeSlot->remaining_slots <= 0) {
                    throw new \Exception("Khung giờ này đã đầy. Vui lòng chọn khung giờ khác.");
                }
    
                $timeSlot->decrement('remaining_slots');
                $appointment->update($validated());
            });
        }

        return AppointmentResource::make($appointment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
    }
}
