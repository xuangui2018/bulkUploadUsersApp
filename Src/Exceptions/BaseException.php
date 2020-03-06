<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;
use Exception;

abstract class BaseException extends Exception {

    protected $data = [];

    /**
     * BaseException constructor.
     *
     * @param string $message
     * @param array $data
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", array $data = [], int $code = 0, Throwable $previous = null)
    {
        $this->data = $data;
        parent::__construct($message, $code, $previous);
    }

    /**
     * Set Exception Data
     *
     * @param string $key
     * @param $value
     * @return void
     */
    public function setData(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * Get Exception Date
     *
     * @return array
     */
    public function getData(): array
    {
        if (count($this->data) === 0) {
            return $this->data;
        }
        return json_decode(json_encode($this->data, true));
    }
}