<?php

declare(strict_types = 1);

namespace App\Exceptions;

use App\Helpers\App;
use Throwable;
use ErrorException;
use ReflectionClass;

class ExceptionHandler
{
    /**
     * Handle exception
     *
     * @param Throwable $exception
     * @return void
     */
    public function handle(Throwable $exception): void
    {
        var_dump($exception);
        exit;
    }
}