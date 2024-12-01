<?php

namespace App\Enums\Model\Profile;

enum InsuranceType: int
{
    case NONE = 1;
    case HEALTH = 2;
    case PRIVATE = 3;
}
