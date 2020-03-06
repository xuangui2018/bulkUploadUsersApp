<?php

declare(strict_types = 1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Src/Exceptions/exception.php';

use App\Helpers\CommandLineArgumentHelper;

$arguments = CommandLineArgumentHelper::formatArgumentArray($argv);

//print_r($arguments);




