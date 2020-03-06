<?php

declare(strict_types = 1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Src/Exceptions/exception.php';

use App\Helpers\CommandLineArgumentHelper;
use App\App;

$arguments = CommandLineArgumentHelper::formatArgumentArray($argv);

$app = new App($arguments);
if ($app->getPrintHelp()) {
    $app->printOutHelpCommands();
} elseif ($app->getCreateTable()) {
    $app->createTable();
} elseif ($app->getDryRun()) {
    $app->readFile()->processFile();
} else {
    $app->readFile()->processFile();
}


