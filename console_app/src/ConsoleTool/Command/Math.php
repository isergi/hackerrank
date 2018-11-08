<?php

namespace ConsoleTool\Command;

/**
 * Math command.
 *
 * The **Math** class is a set off basic math commands.
 * This class just an example how to extend **ACommand** class and
 * how to use it.
 *
 *
 * See **Math** commands examples.
 *
 * @example console.app.php math sum numbers=2,3,4,5
 * @example console.app.php math aug numbers=4,7,2
 */
class Math extends ACommand
{
    
    /**
     * Description how to use Math command
     *
     * @var string
     */
    protected $_description = 'Use "math" command to calculate what you want.' . PHP_EOL . 'Available commands:' . PHP_EOL .
    'sum - to calculate a summary for the numbers' . PHP_EOL . 'aug - to calculate a product of numbers' . PHP_EOL . PHP_EOL .
    'After each comman should be incomming numbers as "numbers" parameter with a list of numbers comma separated' . PHP_EOL .
    'Examples:' . PHP_EOL .  'math sum numbers=2,3,6,3'. PHP_EOL .  'math aug numbers=10,3,4';

    /**
     * Runs avail commands from Math class
     *
     */
    public function runCommand()
    {
        $result = 0;
        if (!empty($this->_params)) {
            reset($this->_params);
            $command = key($this->_params);
            next($this->_params);
            $methodName = '_' . $command . 'Command';
            if (method_exists($this, $methodName)) {
                $params = [];
                if (isset($this->_params['numbers'])) {
                    $params = explode(',', $this->_params['numbers']);
                }
                $result = call_user_func(array($this, $methodName), $params);
            }
        }

        echo 'Result: ', $result, PHP_EOL;
    }

    /**
     * Counts the sum of numbers
     *
     * @param array $numbers List of numbers
     */
    private function _sumCommand($numbers)
    {
        return array_sum($numbers);
    }

    /**
     * Counts the augment of numbers
     *
     * @param array $numbers List of numbers
     */
    private function _augCommand($numbers)
    {
        $result = 1;
        foreach ($numbers as $number) {
            $result *= $number;
        }
        return $result;
    }
}
