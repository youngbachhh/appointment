<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Models\User\Role;

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
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
            ],
            'role' => [
                'required',
                'integer',

                Rule::enum(Role::class),
            ],
            'department_id' => [
                'nullable',
                Rule::requiredIf(fn() => $this->role === Role::DOCTOR->value),
                'integer',
                'exists:departments,id',
            ],
            'specialty' => [
                'nullable',
                Rule::requiredIf(fn() => $this->role === Role::DOCTOR->value),
                'string',
            ],
            'years_of_experience' => [
                'nullable',
                Rule::requiredIf(fn() => $this->role === Role::DOCTOR->value),
                'integer',
                'min:0',
            ],
        ];
    }
}
