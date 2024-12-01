<?php

namespace App\Http\Requests\WorkingHour;

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
                'exists:users,id',
            ],
            'date' => [
                'required',
                'date',
            ],
            'start_time' => [
                'required',
                'date_format:H:i:s',
                'before:end_time',
            ],
            'end_time' => [
                'required',
                'date_format:H:i:s',
                'after:start_time',
            ],
        ];
    }
}
