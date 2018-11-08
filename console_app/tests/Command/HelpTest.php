<?php

namespace Tests\Command;

use PHPUnit\Framework\TestCase;
use ConsoleTool\Command\Help;

class HelpTest extends TestCase
{
    public function testRunCommand()
    {
        $argvTest = [
            'test' => 1
        ];
        $helpCommand = new Help($argvTest);
        ob_start();
        $helpCommand->runCommand();
        $out = ob_get_contents();
        ob_end_clean();

        $this->assertEquals('Use "help" command for each command you want to know more', trim($out));
    }
}
