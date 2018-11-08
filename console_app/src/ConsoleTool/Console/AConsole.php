<?php

namespace ConsoleTool\Console;

use ConsoleTool\Command\ACommand;
use ConsoleTool\Exceptions\CommandException;

/**
 * Abastract AConsole class.
 *
 * The **AConsole** abstract class is the basic class for the all "console" classes.
 * This abstract class asks to implement the runCommand method when you would extend it. 
 *
 */
abstract class AConsole {


    /**
     * Instance of an ACommand implemented class
     *
     * @var ACommand
     */
    public $command = null;

    /**
     * Available commands for an implemented console class
     *
     * $commandList = [
     *  commandName => commandDescription,
     *  ...
     *  commandName => commandDescription
     * ]
     * 
     * @var array
     */
    public $commandList = [];

    /**
     * Shows an information about an implemented console after instance of it.
     *
     * @return void
     */
    final public function __construct() {
        $this->showHowToUse();
    }

    /**
     * Shows an information about Console and how to work with it.
     * This function should be rewritten in an extended class.
     *
     * @return void
     */
    abstract public function showHowToUse(); 

    /**
     * Returns a name of a calling class command from a terminal.
     *
     * @return string
     */
    public function getCommandClassName($command) {
        $className = null;
        if (isset($this->commandList[ $command ])) {
            $className = ucfirst(strtolower($command));
        }

        return 'ConsoleTool\\Command\\' . $className;
    }

    /**
     * Returns a name of a calling class command from a terminal.
     *
     * @throws CommandException if command not found
     * 
     * @return string
     */
    public function setCommand($commandLine) {
        $command = array_shift($commandLine);
        if (is_null($command)) {
            $command = ACommand::HELP_COMMAND;
        }
        if (($className = $this->getCommandClassName($command)) && ($className != 'ConsoleTool\\Command\\')) {
            $params = [];
            if (!empty($commandLine)) {
                foreach ($commandLine as $param) {
                    $paramValues = explode('=', $param);
                    $paramName = array_shift($paramValues);
                    if (!empty($paramValues)) {
                        $params[ $paramName ] = array_shift($paramValues);
                    } else {
                        $params[ $paramName ] = true;
                    }
                }
            }
            $this->command = new $className($params);
        } else {
            throw new CommandException('Command no found!');
        }
    }

    /**
     * Executions incoming command from the terminal
     * 
     * @param $command An instance of implemented ACommand class
     * 
     * @return void
     */
    final public function execCommand(ACommand $command) {
        return $command->execCommand();
    }
}