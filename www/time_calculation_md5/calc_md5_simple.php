<?php

$start = microtime(true);
define('TOTAL_COUNT_NUM', 1000000);
$i = TOTAL_COUNT_NUM;

while($i > 0) {
	md5($i);
	$i--;
}

$finish = microtime(true);

$delta = ($finish - $start) * 1000;

echo 'counted ', TOTAL_COUNT_NUM, ' items for ', $delta . ' ms';

?>