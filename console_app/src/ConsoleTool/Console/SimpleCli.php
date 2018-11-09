<?php

namespace ConsoleTool\Console;

use ConsoleTool\Command\Acommand;

/**
 * SimpleCli console tool.
 */
class SimpleCli extends AConsole
{

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
    protected $_commandList = [
        'help'    => 'Use this command for getting information about executed commands',
        'salary'  => 'Get an information about dates when you should pay salary or bonuses',
        'math'    => 'Just for fun :) Calculate what you want',
    ];

    /**
     * Gets an information about available commands for SimpleCli.
     *
     * @return string Usage information
     */
    public function getUsage()
    {
        $usage = 'Available commands:' . PHP_EOL;
        foreach ($this->_commandList as $command => $comandInfo) {
            $usage .= '[' . $command . "]: " . $comandInfo . PHP_EOL;
        }
        $usage .= PHP_EOL;

        return $usage;
    }
}
