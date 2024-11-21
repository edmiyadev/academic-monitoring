<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum EducationalLevelEnum: int
{
    use EnumTrait;
    case GRADE = 1;
    case MASTER = 2;
    case TECHNICIAN = 3;
}
