<?php

namespace App\Sanitizers;

class DigitsOnlySanitizer
{
    public static function sanitize(?string $value) : ?string
    {
        if ($value !== null)
            return preg_replace('/\D+/', '', $value);

        return null;
    }
}
