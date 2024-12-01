<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Models\User\Role;
use App\Enums\Models\TimeSlot\TimeConfig;

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
        $timeSlot = $this->input('timeSlot');
        $matchedSlot = TimeConfig::getSlot($timeSlot);

        if ($matchedSlot) {
            $this->merge([
                'time_start' => $matchedSlot['start'],
                'time_end' => $matchedSlot['end'],
            ]);
        }

        $this->merge([
            'user_id' => auth()->id(),
        ]);
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
                'exists:users,id',
            ],
            'doctor_id' => [
                'nullable',
                'integer',
                'exists:users,id',
                Rule::exists('users', 'id')->where('role', Role::DOCTOR->value),
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
                Rule::exists('users', 'id')->where('user_id', $this->user_id),
            ],
            'date' => [
                'required',
                'date',
            ],
            'time_start' => [
                'required',
                'date_format:H:i:s',
                'before:time_end',
            ],
            'time_end' => [
                'required',
                'date_format:H:i:s',
                'after:time_start',
            ],
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
