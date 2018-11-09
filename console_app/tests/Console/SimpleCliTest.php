<?php

namespace Tests\Console;

use PHPUnit\Framework\TestCase;
use ConsoleTool\Console\SimpleCli;
use ConsoleTool\Exceptions\CommandException;

class SimpleCliTest extends TestCase
{
    private $console;

    public function setUp()
    {
        $this->console = new SimpleCli();
    }

    public function testShowHowToUse()
    {
        $this->assertEquals(trim('Available commands:
[help]: Use this command for getting information about executed commands
[salary]: Get an information about dates when you should pay salary or bonuses
[math]: Just for fun :) Calculate what you want'), trim($this->console->getUsage()));
    }

    public function testRun()
    {
        $argvTest = [
            0 => 'help'
        ];
        ob_start();
        $this->console->init($argvTest);
        $this->console->run();
        $out = ob_get_contents();
        ob_end_clean();

        $this->assertEquals(trim('Use "help" command for each command you want to know more'), trim($out));

        $argvTest = [
            0 => 'no_exists_command'
        ];
        $this->expectException(CommandException::class);
        $this->expectExceptionMessage('ERROR! Command not found.' . PHP_EOL . PHP_EOL . $this->console->getUsage());
        $this->console->init($argvTest);
    }
}
