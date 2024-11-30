<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum TaskStatusEnum: int
{
    use EnumTrait;

    case Pending = 1;
    case In_progress = 2;
    case Completed = 3;
}
