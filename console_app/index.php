<?php

define('BASE_DIR', __DIR__);

require_once BASE_DIR . '/vendor/autoload.php';

use ConsoleTool\Console\ConsoleWorker;
use ConsoleTool\Exceptions\CommandException;

$console = new ConsoleWorker();

$incomeLine = $argv;
array_shift($incomeLine);

if ($incomeLine) {
    try {
        $console->setCommand($incomeLine);
        $console->run();
    } catch (CommandException $e){
        echo 'ERROR: ', $e->getMessage(), PHP_EOL;
    }
}