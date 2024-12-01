<?php

namespace App\Enums\Model\Appointment;

enum StatusType: int
{
    case PENDING = 1;
    case CONFIRMED = 2;
    case CANCELLED = 3;
}