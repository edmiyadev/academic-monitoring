<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum SemesterEnum: int
{
    use EnumTrait;
    case First = 1;
    case Second = 2;
    case Third = 3;
    case Fourth = 4;
    case Fifth = 5;
    case Sixth = 6;
    case Seventh = 7;
    case Eighth = 8;
    case Ninth = 9;
    case Tenth = 10;
    case Eleventh = 11;
    case Twelfth = 12;
    case Thirteenth = 13;
    case Fourteenth = 14;
    case Sixteenth = 15;
    case Seventeenth = 16;
}
