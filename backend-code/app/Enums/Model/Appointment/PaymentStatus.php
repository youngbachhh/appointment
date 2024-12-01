<?php

namespace App\Enums\Model\Appointment;

enum PaymentStatus: int
{
    case PENDING = 1;
    case PAID = 2;
    case CANCELLED = 3;
}
