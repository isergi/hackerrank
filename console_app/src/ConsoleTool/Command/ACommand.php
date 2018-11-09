<?php

namespace ConsoleTool\Command;

/**
 * Abstract ACommand class.
 *
 * The **ACommand** stores params and executes commands
 */
abstract class ACommand
{

    /**
     * The default value of the "help" command, shows a usage for a command
     */
    const HELP_COMMAND = 'help';

    /**
     * The description of how to use a command which would be executed.
     * This var will be used when the console would ask a usage for the command.
     *
     * @var string
     */
    protected $_description = "";

    /**
     * Incoming params of the executed command.
     *
     * $params = [
     *       'key'     => 'value',
     *       ...
     *       'key1'    => 'value1'
     *     ]
     *
     * @var array
     */
    protected $_params = [];

    /**
     * Creates new instance.
     *
     * @param array $params array of arguments passed to script.
     */
    public function __construct($params = [])
    {
        $this->_params = $params;
    }

    /**
     * Shows a usage for a command.
     */
    public function showHelpMessage()
    {
        echo $this->_description, PHP_EOL, PHP_EOL;
    }

    /**
     * Executes a command or shows a usage
     * if the application asks "help" for an extended command.
     */
    final public function execCommand()
    {
        if (isset($this->_params[self::HELP_COMMAND])) {
            $this->showHelpMessage();
        } else {
            $this->runCommand();
        }
    }

    /**
     * Abstract method should be rewriten by an external classes.
     * Executes defined actions.
     */
    abstract public function runCommand();
}
