<?php

namespace App\Enums\Models\User;

enum Role: int
{
    case ADMIN = 1;
    case DOCTOR = 2;
    case PATIENT = 3;
}
