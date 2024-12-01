<?php

namespace App\Http\Requests\Doctor;

use App\Models\User;
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
        $user = User::find($this->user_id);
        $age = now()->diffInYears($user->profile->birthdate);
        return [
            'user_id' => ['
                required',
                'unique:doctors,user_id',
                'exists:users,id',
            ],
            'specialty' => [
                'nullable', 
                'string'
            ],
            'years_of_experience' => [
                'nullable',
                'integer',
                'min:0',
                'max:' . $age - 25,
            ],
        ];
    }
}
