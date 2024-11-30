<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum StudentEnrollmentStatusEnum: int
{
    use EnumTrait;
    case Not_Approved = 1;
    case Approved = 2;
    case Progress = 3;
}
