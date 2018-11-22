<?php

namespace Sasaya;

class Fuzzy
{
    public static function match(string $needle, string $haystack): bool
    {
        $needles = str_split($needle);

        while ($needle = array_shift($needles)) {
            $rest = strstr($haystack, $needle);

            if (!$rest) {
                return false;
            }

            if (!count($needles)) {
                return true;
            }

            $haystack = substr($rest, 1);
        }

        return false;
    }

    public static function search(string $needle, array $haystack): array
    {
        return array_filter($haystack, function ($row) use ($needle) {
            return static::match($needle, $row);
        });
    }
}
