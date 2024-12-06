<?php

namespace App\Enums\Models\Service;

enum PaymentType: int
{
    case PAY_ONLINE = 1;
    case PAY_OFFLINE = 2;
}
