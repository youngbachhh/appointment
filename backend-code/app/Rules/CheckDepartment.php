<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckDepartment implements Rule
{

    private $department_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($department_id)
    {
        $this->department_id = $department_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value->service->department_id == $this->department_id;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
