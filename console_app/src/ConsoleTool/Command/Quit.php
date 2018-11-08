<?php

namespace ConsoleTool\Command;

/**
 * Quit command.
 *
 * The **Quit** Just closes an application
 *
 * See **Quit** commands examples.
 *
 * @example console.app.php quit
 */
class Quit extends ACommand {
    
    /**
     * Description how to use Help command
     *
     * @var string
     */
    protected $_description = 'Use "quit" command to quit from a command line';

    /**
     * Exits from an application
     * 
     * @return void
     */
    public function runCommand() {
        echo 'See you...', PHP_EOL;
        exit;
    }
}