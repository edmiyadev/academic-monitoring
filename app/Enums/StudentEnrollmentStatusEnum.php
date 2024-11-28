<?php

namespace App\Enums;

enum StudentEnrollmentStatusEnum: int
{
    case Pending = 1;
    case Approved = 2;
    case Progress = 3;
}
