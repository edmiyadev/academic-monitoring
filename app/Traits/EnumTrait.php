<?php

namespace App\Traits;

trait EnumTrait
{
    public static function getKeys()
    {
        return array_map(function ($case) {
            return $case->name;
        }, self::cases());

    }

    public static function getValues()
    {
        return array_map(function ($case) {
            return $case->value;
        }, self::cases());
    }

    public static function getNameByValue(string $value): ?string
    {
        foreach (self::cases() as $case) {
            if ($case->value == $value) {
                return $case->name;
            }
        }
        return null;
    }
}
