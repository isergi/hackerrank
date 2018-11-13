<?php

namespace ConsoleTool\Command;

/**
 * Salary command.
 *
 * The **Salary** class calculates and shows dates on which they need to pay salaries
 * to their Sales Department.
 *
 * The company handles their Sales payroll in the following way:
 * Sales staff get a regular fixed base monthly salary, plus a monthly bonus
 * The base salaries are paid on the last day of the month, unless that day is a Saturday or a
 * Sunday (weekend). In that case, salaries are paid before the weekend. For the sake of this
 * application, please do not take into account public holidays.
 * On the 15th of every month bonuses are paid for the previous month, unless that day is a
 * weekend. In that case, they are paid the first Wednesday after the 15th
 *
 * The output of the utility should be a CSV file,
 * containing the payment dates for the next twelve months.
 * The CSV file should contain a column for the month name, a column that contains the salary.
 *
 * See **Salary** commands examples.
 *
 * ```bash
 * ./c-tool salary
 * ```
 */
class Salary extends ACommand
{
    
    /**
     * Description how to use Salary command
     *
     * @var string
     */
    protected $_description = 'Use "salary" command to get an information about the dates on which you need to pay salaries or bonuses.' . PHP_EOL .
    PHP_EOL . 'Params:' . PHP_EOL . '"start" (not required, default current month) - to set a start date of a calculated period' . PHP_EOL .
    '"end" (not required, default +12 months from "start" date) - to set an end date of a calculated period' . PHP_EOL .
    '"file" (not required, default output to the terminal) - file name with result in CSV format' . PHP_EOL .
    PHP_EOL . 'Format for each date is "YYYY-MM"' . PHP_EOL .
    PHP_EOL . 'Examples:' . PHP_EOL .  'salary start=2018-01'. PHP_EOL .  'salary start=2018-06 end end=2018-12' . PHP_EOL .  'salary file="my_results"'
    ;

    /**
     * Calculates and shows dates on which you need to pay salaries or bonuses.
     * This function also generates CSV file with results on demand or put results into stdout.
     *
     * @return void
     */
    public function runCommand()
    {
        if (isset($this->_params['start']) && preg_match('/^\d{4}\-\d{2}/', $this->_params['start'])) {
            $startDate = $this->_params['start'];
        } else {
            $startDate = date('Y-m');
        }

        if (isset($this->_params['end']) && preg_match('/^\d{4}\-\d{2}/', $this->_params['end']) && $startDate < $this->_params['end']) {
            $endDate = $this->_params['end'];
        } else {
            $endDate = date('Y-m', strtotime('+12 month', strtotime($startDate)));
        }

        $startTimestamp = strtotime($startDate);
        $endTimestamp =  strtotime($endDate);
        $calculatedMonth = strtotime('+1 month', $startTimestamp);
        $resultData = [['Month', 'Salary payment date', 'Bouns payment date']];
        for ($i = 1; $calculatedMonth <= $endTimestamp; $i++, $calculatedMonth = strtotime('+' . $i . ' month', $startTimestamp)) {
            $resultData[] = [date('Y F', $calculatedMonth), $this->_getSalaryWorkingDay($calculatedMonth), $this->_getBonusWorkingDay($calculatedMonth)];
        }

        if (isset($this->_params['file'])) {
            $fp = fopen($this->_params['file'] . '.csv', 'w');
            foreach ($resultData as $resultLine) {
                fputcsv($fp, $resultLine);
            }
            fclose($fp);
            echo 'Results saved into file "' , $this->_params['file'] , '.csv' , '"', PHP_EOL;
        } else {
            foreach ($resultData as $resultLine) {
                echo $resultLine[0], str_repeat(' ', 17 - strlen($resultLine[0])), $resultLine[1], str_repeat(' ', 22 - strlen($resultLine[1])), $resultLine[2], PHP_EOL;
            }
        }
    }

    /**
     * Returns the date of the latest working day in a month.
     *
     * @param string $month Incoming month in format YYYY-MM
     * @return string the latest working day in a month in format YYYY-MM-DD
     */
    private function _getSalaryWorkingDay($month)
    {
        $lastMonthDay = date('Y-m-t', $month);
        $dayOfWeek = date('N', strtotime($lastMonthDay));
        if ($dayOfWeek > 5) {
            $oneDay = 24*60*60;
            $lastMonthDay = date('Y-m-d', strtotime($lastMonthDay) - ($oneDay*($dayOfWeek - 5)));
        }

        return $lastMonthDay;
    }

    /**
     * Returns the date of the next working day after 15th of a month.
     *
     * @param string $month Incoming month in format YYYY-MM
     * @return string next working day after 15th of a month in format YYYY-MM-DD
     */
    private function _getBonusWorkingDay($month)
    {
        $payBonusDay = date('Y-m-15', $month);
        $dayOfWeek = date('N', strtotime($payBonusDay));
        if ($dayOfWeek > 5) {
            $oneDay = 24*60*60;
            $payBonusDay = date('Y-m-d', strtotime($payBonusDay) + ($oneDay*(8-$dayOfWeek)));
        }

        return $payBonusDay;
    }
}
