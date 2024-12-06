<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Registration;

class SameClinic implements Rule
{
    protected $currentClinicId;

    public function __construct($currentClinicId)
    {
        $this->currentClinicId = $currentClinicId;
    }

    public function passes($attribute, $value)
    {
        $registration = Registration::find($value);
        return $registration && $registration->clinic_id == $this->currentClinicId;
    }

    public function message()
    {
        return 'The selected registration does not belong to the same clinic.';
    }
}