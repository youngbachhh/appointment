<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Models\User\Role;
use App\Rules\CheckDepartment;

class UpdateRequest extends FormRequest
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
                Rule::exists('users', 'id')->where('role', Role::DOCTOR->value),
                new CheckDepartment($this->department_id),
            ],
            'service_id' => [
                'required',
                'integer',
                'exists:services,id',
                Rule::exists('services', 'id')->where(function ($query) {
                    $query->where('department_id', $this->department_id);
                }),
            ],
            'profile_id' => [
                'required',
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
            'created_by' => [
                'nullable',
                'integer',
                'exists:users,id',
            ],
        ];
    }
}
