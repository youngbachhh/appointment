<?php

namespace App\Enums\Model\User;

enum Role: int
{
    case ADMIN = 1;
    case DOCTOR = 2;
    case PATIENT = 3;
}
