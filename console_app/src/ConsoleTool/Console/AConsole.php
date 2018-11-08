<?php

namespace ConsoleTool\Console;

use ConsoleTool\Command\ACommand;
use ConsoleTool\Exceptions\CommandException;

/**
 * Abstract AConsole class.
 *
 * The **AConsole** abstract class is the basic class for the all "console" classes.
 */
abstract class AConsole
{

    /**
     * Instance of an ACommand implemented class
     *
     * @var ACommand
     */
    protected $_command = null;

    /**
     * Available commands for a console class
     *
     * $_commandList = [
     *  commandName  => commandDescription,
     *  ...
     *  commandName1 => commandDescription1
     * ]
     *
     * @var array
     */
    protected $_commandList = [];

    /**
     * Gets an information about available commands.
     *
     * @return string
     */
    abstract public function getUsage();

    /**
     * Returns a class name of a calling command.
     *
     * @return string
     */
    public function getCommandClassName($command)
    {
        $className = null;
        if (isset($this->_commandList[ $command ])) {
            $className = ucfirst(strtolower($command));
        }

        return 'ConsoleTool\\Command\\' . $className;
    }

    /**
     * Parses cli incoming args and instantiates a command class.
     *
     * @param array $args array of arguments passed to script
     *
     * @return void
     * 
     * @throws CommandException if command not found
     */
    public function init($args)
    {
        $command = array_shift($args);
        if (($className = $this->getCommandClassName($command)) && ($className != 'ConsoleTool\\Command\\')) {
            $params = [];
            if (!empty($args)) {
                foreach ($args as $param) {
                    $paramValues = explode('=', $param);
                    $paramName = array_shift($paramValues);
                    if (!empty($paramValues)) {
                        $params[ $paramName ] = array_shift($paramValues);
                    } else {
                        $params[ $paramName ] = true;
                    }
                }
            }
            $this->_command = new $className($params);
        } else {
            throw new CommandException('ERROR! Command not found.' . PHP_EOL . PHP_EOL . $this->getUsage(), 1);
        }
    }

    /**
     * Executions incoming command from the terminal
     *
     * @param $command An instance of implemented ACommand class
     *
     * @return void
     */
    final public function run()
    {
        if (!is_null($this->_command) && $this->_command instanceof ACommand) {
            $this->_command->execCommand();
        }
    }
}
