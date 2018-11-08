<?php

namespace ConsoleTool\Command;

/**
 * Abstract ACommand class.
 *
 * The **ACommand** asks to implement the runCommand method. 
 */
abstract class ACommand {

    /**
     * The default value of the "help" command, shows a manual for a command
     */
    const HELP_COMMAND = 'help';

    /**
     * The description of how to use a command which would be extended. 
     * This var will be used when the console would ask a manual of the command..
     *
     * @var string
     */
    protected $_description = "";

    /**
     * Incoming params of the called command. 
     * 
     * $params = [
     *       'key'     => 'value',
     *       ...
     *       'key'     => 'value'
     *     ]
     *
     * Where "key" is the name of the extra param and "value" the value of this extra parameter.
     * 
     * @var array
     */
    protected $_params = [];

    /**
     * Creates new ACommand instance.
     * 
     * @param array $params It is $argv parameters which was called within the command line.
     */
    final public function __construct($params = []) {
        $this->_params = $params;
    }

    /**
     * Shows a manual of an extended ACommand class.
     * Uses public $description var.
     */
    public function showHelpMessage() {
        echo $this->_description, PHP_EOL, PHP_EOL;
    }

    /**
     * Executes an extended ACommand class command or 
     * shows a manual of an extended ACommand class 
     * if the application asks "help" for an extended command.
     */
    final public function execCommand() {
        if (isset($this->_params[self::HELP_COMMAND])) {
            $this->showHelpMessage();
        } else {
            $this->runCommand();
        }
    }

    /**
     * Abstract method should be rewriten in an extended ACommand classes. 
     * This method executes when a command asked in the console.
     */
    abstract public function runCommand();
}