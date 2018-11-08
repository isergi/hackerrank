<?php

namespace Tests\Console;

use PHPUnit\Framework\TestCase;
use ConsoleTool\Console\ConsoleWorker;
use ConsoleTool\Exceptions\CommandException;

class ConsoleWorkerTest extends TestCase
{
    public function testShowHowToUse()
    {
        ob_start();
        $console = new ConsoleWorker();
        $out = ob_get_contents();
        ob_end_clean();

        $this->assertEquals(trim('Available commands:
[help]: Use this command for each command you want to know more
[quit]: Use this command to close the application
[salary]: Get an information about dates when you should pay salary or bonus
[math]: Calculate what you want'), trim($out));
    }

    public function testRun()
    {
        $argvTest = [
            0 => 'help'
        ];
        ob_start();
        $console = new ConsoleWorker();
        ob_end_clean();
        ob_start();
        $console->setCommand($argvTest);
        $console->run();
        $out = ob_get_contents();
        ob_end_clean();

        $this->assertEquals(trim('Use "help" command for each comman you want to know more'), trim($out));

        $argvTest = [
            0 => 'no_exists_command'
        ];
        $this->expectException(CommandException::class);
        $this->expectExceptionMessage("Command no found!");
        $console->setCommand($argvTest);
    }
}