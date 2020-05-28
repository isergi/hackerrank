<?php

// Proc splitting part
define('PROCS_COUNT', 4);
define('COUNT_NUMBERS', 1000000);

echo PHP_EOL;

$start = microtime(true);

// Split count_numbers by process counts
$procCountParts = ceil(COUNT_NUMBERS / PROCS_COUNT);

$pars_numbers = [];
for ($i = 0; $i < PROCS_COUNT; $i++) {
	$pars_numbers[] =
	[
		'start' => ($i * $procCountParts) + 1,
		'end'	=> ($i+1 == PROCS_COUNT) ? COUNT_NUMBERS : ($procCountParts * ($i+1))
	];
}

// This loop creates a new fork for each of the items in $tasks.
foreach ($pars_numbers as $start_end_values) {
	$pid = pcntl_fork();
	if ($pid == -1) {
	exit("Error forking...\n");
	} else if ($pid == 0) {
		$start = $start_end_values['start'];
		$end = $start_end_values['end'];
		$echo_str = ' Counting from ' . $start . ' to ' . $end;
		$start_time = microtime(true);
		while($end >= $start) {
			md5($start);
			$start++;
		}

		$finish = microtime(true);

		$delta = ($finish - $start_time) * 1000;
		echo $echo_str . ' for ', $delta . ' ms', PHP_EOL;
		exit();
	}
}

// This while loop holds the parent process until all the child threads
// are complete - at which point the script continues to execute.
while(pcntl_waitpid(0, $status) != -1);

$finish = microtime(true);

$delta = ($finish - $start) * 1000;

echo PHP_EOL, ' Counted ', COUNT_NUMBERS, ' items for ', $delta . ' ms';

exit;

?>