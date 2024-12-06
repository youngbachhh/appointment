<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Models\User\Role;
use App\Enums\Models\TimeSlot\TimeConfig;
use App\Models\DoctorService;
use App\Enums\Models\Appointment\StatusType;
use App\Models\TimeSlot;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $timeSlot = $this->input('time_slot');
        $matchedSlot = TimeConfig::getSlot($timeSlot);
        $serviceId = $this->input('service_id');
        $date = $this->input('date');

        $timeSlotAvailable = TimeSlot::where([
                ['service_id', '=', $serviceId],
                ['date', '=', $date],
                ['start_time', '=', $matchedSlot['start']],
                ['end_time', '=', $matchedSlot['end']],
            ])
            ->first()
        ;

        $doctorId = DoctorService::where('service_id', $serviceId)
            ->first()
            ->value('doctor_id')
        ;

        if ($matchedSlot
            && $doctorId
            // && auth()->user()
            && $timeSlotAvailable->remaining_slots >= 1
        ) {
            $this->merge([
                // 'time_start' => $matchedSlot['start'],
                // 'time_end' => $matchedSlot['end'],
                'doctor_id' => $doctorId,
                'user_id' => $this->user_id,
                'status' => StatusType::PENDING->value,
                'time_slot_id' => $timeSlotAvailable->id,
            ]);
        }

        if ($timeSlotAvailable->remaining_slots <= 0) {
            $this->merge([
                'status' => StatusType::CANCELLED->value,
            ]);
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'doctor_id' => [
                'nullable',
                'integer',
                'exists:doctors,id',
            ],
            'service_id' => [
                'required',
                'integer',
                'exists:services,id',
            ],
            'profile_id' => [
                'nullable',
                'integer',
                'exists:profiles,id',
            ],
            'time_slot_id' => [
                'required',
                'integer',
                'exists:time_slots,id',
            ],
            // 'date' => [
            //     'required',
            //     'date',
            //     'after_or_equal:today',
            // ],
            // 'time_start' => [
            //     'required',
            //     'date_format:H:i',
            //     'before:time_end',
            // ],
            // 'time_end' => [
            //     'required',
            //     'date_format:H:i',
            //     'after:time_start',
            // ],
            'status' => [
                'required',
                'integer',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ];
    }
}
