<?php

namespace App\Http\Requests\TimeSlot;

use Illuminate\Foundation\Http\FormRequest;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'doctor_id' => [
                'required',
                'integer',
            ],
            'service_id' => [
                'required',
                'integer',
            ],
            'start_time' => [
                'required',
                'date_format:H:i',
                'before:end_time',
            ],
            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],
            'date' => [
                'required',
                'date',
            ],
            'remaining_slots' => [
                'required',
                'integer',
                'min:1',
            ],
        ];
    }
}
