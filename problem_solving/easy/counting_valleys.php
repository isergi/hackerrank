<?php

function countingValleys($n, $s) {

    $strLen = strlen($s)-1;
    $startPos = 0;
    $valleys = 0;
    $underSea = false;
    for ($i = 0; $i <= $strLen; $i++) {
        if ($startPos < 0) {
            $underSea = true;
        }

        $startPos+= (($s[$i] == 'U') ? 1 : -1);

        if (!$underSea) {
            continue;
        }
        if ($startPos == 0) {
            $underSea = false;
            $valleys++;
        }
    }

    return $valleys;
}

print_r(countingValleys(8, 'UDDDUDUU'));
