<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Models\Profile\Gender;
use App\Enums\Models\Profile\InsuranceType;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'national_id' => [
                'required',
                'string',
                'max:255',
            ],
            'birthdate' => [
                'required',
                'date',
            ],
            'gender' => [
                'required',
                Rule::enum(Gender::class),
            ],
            'province_id' => [
                'required',
                'integer',
                'exists:provinces,id',
            ],
            'ethnicity' => [
                'required',
                'string',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'max:255',
            ],
            'address' => [
                'required',
                'string',
                'max:255',
            ],
            'job' => [
                'nullable',
                'string',
                'max:255',
            ],
            'insurance_type' => [
                'required',
                'integer',
                Rule::enum(InsuranceType::class),
            ],
            'insurance_number' => [
                'nullable',
                'string',
                'max:255',
            ],
            'insurance_expiration' => [
                'nullable',
                'date',
            ],
            'priority' => [
                'required',
                'integer',
                'min:0',
            ],
            'status' => [
                'required',
                'integer',
                'min:0',
                'max:1',
            ],
        ];
    }
}
