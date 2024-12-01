<?php

namespace App\Enums\Models\Appointment;

enum StatusType: int
{
    case PENDING = 1;
    case CONFIRMED = 2;
    case CANCELLED = 3;
}
