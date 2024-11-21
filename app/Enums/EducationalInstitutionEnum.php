<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum EducationalInstitutionEnum: int
{
    use EnumTrait;

    case UASD = 1;
    case UTESA = 2;
}
