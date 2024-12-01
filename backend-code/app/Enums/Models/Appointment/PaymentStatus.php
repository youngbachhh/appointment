<?php

namespace App\Enums\Models\Appointment;

enum PaymentStatus: int
{
    case PENDING = 1;
    case PAID = 2;
    case CANCELLED = 3;
}
