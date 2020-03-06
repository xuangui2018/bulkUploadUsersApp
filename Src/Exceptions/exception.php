<?php

set_error_handler([new \App\Exceptions\ExceptionHandler(), 'convertErrorsToException']);
set_exception_handler([new \App\Exceptions\ExceptionHandler(), 'handle']);