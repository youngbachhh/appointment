<?php

namespace App\Http\Requests\Service;

use App\Enums\Models\Service\PaymentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'department_id' => [
                'required',
                'integer',
                'exists:departments,id',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'amount' => [
                'required',
                'numeric',
            ],
            'type' => [
                'required',
                'string',
                Rule::enum(PaymentType::class),
            ],
        ];
    }
}
