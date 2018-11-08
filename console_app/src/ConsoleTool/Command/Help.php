<?php

namespace ConsoleTool\Command;

/**
 * Help command.
 *
 * The **Help** Just show the message that you can use it command with each function you want to know more. 
 *
 * See **Help** commands examples.
 *
 * @example console.app.php help
 */
class Help extends ACommand {
    
    /**
     * Description how to use Help command
     *
     * @var string
     */
    protected $_description = 'Use "help" command for each comman you want to know more';

    /**
     * Shows the message about Help command
     * 
     * @return void
     */
    public function runCommand() {
        $this->showHelpMessage();
    }
}