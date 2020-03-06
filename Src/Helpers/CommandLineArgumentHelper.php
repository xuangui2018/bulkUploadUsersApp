<?php

declare(strict_types = 1);

namespace App\Helpers;

class CommandLineArgumentHelper
{
    /**
     * Format argument array
     *
     * @param string $args
     * @return array
     */
    public static function formatArgumentArray(array $args): array
    {
        $arguments = array();
        foreach ($args as $arg) {
            if (preg_match('#^-{1,2}([a-zA-Z0-9_]*)=?(.*)$#', $arg, $matches)) {
                $key = $matches[1];
                switch ($matches[2]) {
                    case '':
                        $value = true;
                        break;
                    default:
                        $value = $matches[2];
                }
                $arguments[$key] = $value;
            }
        }
        return $arguments;
    }
}
