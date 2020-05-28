<?php

if (!empty($argv[1]) && !empty($argv[2]) && !empty($argv[3]) && ($argv[3] == 'is_fork')) {
	$start = $argv[1];
	$end = $argv[2];

	$echo_str = ' Counting from ' . $start . ' to ' . $end;
	$start_time = microtime(true);
	while($end >= $start) {
		md5($start);
		$start++;
	}

	$finish = microtime(true);

	$delta = ($finish - $start_time) * 1000;
	echo $echo_str . ' for ', $delta . ' ms', PHP_EOL;
	exit;
}

define('PROCS_COUNT', 4);
define('COUNT_NUMBERS', 1000000);

$procCountParts = ceil(COUNT_NUMBERS / PROCS_COUNT);

$pars_numbers = [];
for ($i = 0; $i < PROCS_COUNT; $i++) {
	$pars_numbers[] =
	[
		'start' => ($i * $procCountParts) + 1,
		'end'	=> ($i+1 == PROCS_COUNT) ? COUNT_NUMBERS : ($procCountParts * ($i+1))
	];
}

$descriptorspec = array(
	0 => array("pipe", "r")
);

$start = microtime(true);
$procs = [];

for ($procsCounter = PROCS_COUNT; $procsCounter > 0; $procsCounter--) {
	$procs[ $procsCounter ] = proc_open('php ' . __DIR__ . DIRECTORY_SEPARATOR . 'calc_md5_procs.php ' . $pars_numbers[ $procsCounter-1 ]['start'] . ' ' . $pars_numbers[ $procsCounter-1 ]['end'] . ' is_fork', $descriptorspec, $pipes, NULL, $_ENV);
}

while (!empty($procs)) {
	foreach ($procs as $k => $v) {
		$pstatus = proc_get_status($procs[ $k ]);
		if (!$pstatus['running']) {
			unset($procs[ $k ]);
		}
	}
}

$finish = microtime(true);

$delta = ($finish - $start) * 1000;

echo 'counted ', COUNT_NUMBERS, ' items for ', $delta . ' ms';




?>