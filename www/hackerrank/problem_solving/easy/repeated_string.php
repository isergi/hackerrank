<?php

function repeatedString($s, $n)
{
    $strLen = strlen($s);
    $countInStr = 0;
    $sPosCounters = [];
    for ($i=0; $i < $strLen; $i++) {
        if ($s[$i] == 'a') {
            $countInStr++;
        }
        $sPosCounters[$i+1] = $countInStr;
    }

    $clearRepeat = floor($n/$strLen);
    $countInStr *= $clearRepeat;
    if (($n % $strLen) != 0) {
        $countInStr += $sPosCounters[$n - ($strLen*$clearRepeat)];
    }

    return $countInStr;
}

echo '<pre>';
print_r(
    [
    'aba, 10'        => repeatedString('aba', 10),        // Expected 7
    'a, 10000000000' => repeatedString('a', 10000000000), // Expected 10000000000
    'qwajaas, 10000' => repeatedString('qwajaas', 10000), // Expected 4285
    ]
);
echo '<pre>';
