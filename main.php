<?php

declare(strict_types = 1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Helpers\CommandLineArgumentHelper;
use App\App;

$arguments = CommandLineArgumentHelper::formatArgumentArray($argv);

//print_r($arguments);

$app = new App($arguments);
if ($app->getPrintHelp()) {
    $app->printOutHelpCommands();
} else {

}


