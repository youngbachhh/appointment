<?php

namespace App\Http\Requests\Profile;

use App\Enums\Models\Profile\Gender;
use App\Enums\Models\Profile\InsuranceType;
use Illuminate\Validation\Rule;
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
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
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
                Rule::requiredIf(fn() => $this->insurance_type !== InsuranceType::NONE->value),
                'string',
                'max:255',
            ],
            'insurance_expiration' => [
                'nullable',
                Rule::requiredIf(fn() => $this->insurance_type !== InsuranceType::NONE->value),
                'date',
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
