<?php

declare(strict_types = 1);

namespace App\Helpers;

class HumanNameFormatHelper
{
    public static function format(string $name): string
    {
        $formattedName = ucwords(strtolower(trim($name)));

        $separators = array(" ", "-", "+", "'");
        foreach ($separators as $separator) {
            if (strpos($formattedName, $separator)) {
                $word = explode($separator, $formattedName);
                $tempArray = array_map("ucfirst", array_map("strtolower", $word));
                $formattedName = implode($separator, $tempArray);
            }
        }
        return $formattedName;
    }
}
