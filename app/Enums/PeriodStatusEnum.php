<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum PeriodStatusEnum: int
{
    use EnumTrait;
    case In_progress = 1;
    case Finalized = 2;
}
