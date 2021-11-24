<?php

namespace App\Sanitizers;

class DigitsOnlySanitizer
{
    public static function sanitize(?string $value) : ?string
    {
        if ($value !== null)
        {
            $value = preg_replace('/\D+/', '', $value);

            return preg_replace('/^./', '7', $value);
        }

        return null;
    }
}
