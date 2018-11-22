<?php

namespace Tests\Command;

use PHPUnit\Framework\TestCase;
use ConsoleTool\Command\Math;

class MathTest extends TestCase
{
    public function testRunCommandSum()
    {
        $commandParamsTest = [
            'sum' => 1,
            'numbers' => '1,2',
        ];
        $helpCommand = new Math($commandParamsTest);
        ob_start();
        $helpCommand->runCommand();
        $out = ob_get_contents();
        ob_end_clean();

        $this->assertEquals('Result: 3', trim($out));
    }

    public function testRunCommandAug()
    {
        $commandParamsTest = [
            'aug' => 1,
            'numbers' => '3,2',
        ];
        $helpCommand = new Math($commandParamsTest);
        ob_start();
        $helpCommand->runCommand();
        $out = ob_get_contents();
        ob_end_clean();

        $this->assertEquals('Result: 6', trim($out));
    }
}
