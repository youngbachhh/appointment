<?php

namespace App\Enums\Models\Profile;

enum Priority: int
{
    case OTHER = 1;
    case CHILDREN = 2;
    case ELDERLY = 3;
}
