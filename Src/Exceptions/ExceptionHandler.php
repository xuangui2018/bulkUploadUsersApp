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
     * Handle Exception
     *
     * @param Throwable $exception
     * @return void
     */
    public function handle(Throwable $exception): void
    {
        var_dump($exception);
        exit;
    }

    public function convertErrorsToException($severity, $message, $file, $line)
    {
        throw new ErrorException($message, $severity, $severity, $file, $line);
    }

//    private function parseExceptionResponse(Throwable $exception): array
//    {
//        $response = [];
//        $response['code'] = $exception->getCode();
//        $response['message'] = $exception->getMessage();
//        $response['line'] = $exception->getLine();
//        $response['file'] = $exception->getFile();
//        $response['trace'] = $exception->getTrace();
//
//        $object = new ReflectionClass(get_class($exception));
//        if ($object->isSubclassOf(Main::class)) {
//            $response['data'] = $exception->getExtraData();
//        }
//        $response['exceptionClass'] = $object->getName();
//
//        return $response;
//    }
}