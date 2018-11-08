<?php

namespace ConsoleTool\Console;

use ConsoleTool\Command\Acommand;

/**
 * Worker for AConsole class.
 *
 * The **ConsoleWorker** class is an extension of AConsole class.
 * This class shows a list of available commands and runs commands asked from the terminal.
 *
 */
class ConsoleWorker extends AConsole {

    /**
     * Available commands for an implemented console class
     *
     * $_commandList = [
     *  commandName => commandDescription,
     *  ...
     *  commandName => commandDescription
     * ]
     * 
     * @var array
     */
    protected $_commandList = [
        'help'    => 'Use this command for each command you want to know more',
        'quit'    => 'Use this command to close the application',
        'salary'  => 'Get an information about dates when you should pay salary or bonus',
        'math'    => 'Calculate what you want',
    ];

    /**
     * Shows an information about available command for ConsoleWorker.
     *
     * @return void
     */
    public function showHowToUse() {
        echo 'Available commands:', PHP_EOL;
        foreach ($this->_commandList as $command => $comandInfo) {
            echo '[', $command, "]: ", $comandInfo, PHP_EOL;
        }
        echo PHP_EOL;
    }

    /**
     * Executes a command with its params.
     *
     * @return void
     */
    public function run() {
        if (!is_null($this->command) && $this->command instanceof ACommand) {
            $this->execCommand($this->command);
        }
    }
}