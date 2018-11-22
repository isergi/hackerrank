<?php

namespace Tests\Command;

use PHPUnit\Framework\TestCase;
use ConsoleTool\Command\Salary;

class SalaryTest extends TestCase
{
    const TESTED_FILE_NAME = 'SalaryTest';

    public function testRunCommand()
    {
        $argvTest = [
            'start'  => '2018-01',
            'file'   => self::TESTED_FILE_NAME
        ];
        $helpCommand = new Salary($argvTest);
        ob_start();
        $helpCommand->runCommand();
        ob_end_clean();

        $generatedFileName = __DIR__ . '/../../' . self::TESTED_FILE_NAME . '.csv';
        $this->assertFileExists($generatedFileName);
        $this->assertFileEquals(__DIR__ . '/' . self::TESTED_FILE_NAME . '.csv', $generatedFileName);
        unlink($generatedFileName);
    }
}
