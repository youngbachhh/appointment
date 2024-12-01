<?php

namespace App\Services;

use App\Models\WorkingHour;
use App\Models\Appointment;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Enums\Models\Appointment\StatusType;

class WorkingHourService
{
    public function updateWorkingHours(Request $request, $doctorId)
    {
        $workingHours = WorkingHour::updateOrCreate(
            [
                'doctor_id'     => $doctorId,
                'date'          => $request->date,
            ],
            [
                'start_time'    => $request->start_time,
                'end_time'      => $request->end_time,
            ]
        );

        $affectedAppointments = Appointment::where('doctor_id', $doctorId)
            ->where('date', $request->date)
            ->where(function ($query) use ($request) {
                $query
                    ->where('start_time', '<', $request->start_time)
                    ->orWhere('end_time', '>', $request->end_time);
            })
            ->get()
        ;

        foreach ($affectedAppointments as $appointment) {
            Notification::create([
                'user_id' => $appointment->patient_id,
                'message' => 'Lịch hẹn của bạn vào ' . $appointment->date . ' lúc ' . $appointment->start_time . ' đã bị thay đổi do có sự thay đổi trong lịch làm việc của bác sĩ.',
            ]);

            $appointment->status = StatusType::CANCELLED->value;
            $appointment->save();
        }
    }
}
