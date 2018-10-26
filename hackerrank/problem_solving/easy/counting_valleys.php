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

echo '<pre>';
print_r([
        '8, UDDDUDUU' => countingValleys(8, 'UDDDUDUU'), // Expected 1
        '12, DDUUDDUDUUUD' => countingValleys(12, 'DDUUDDUDUUUD'), // Expected 2
        '30, DDUUDDUDUDUDDUDUUUDDDUDUUDUDUUUD' => countingValleys(30, 'DDUUDDUDUDUDDUDUUUDDDUDUUDUDUUUD'), // Expected 3
        '22, DDUDDUUUUDDDUDDUDUUDUD' => countingValleys(22, 'DDUDDUUDUDDDUDDUDUUDUD')]); // Expected 0
echo '</pre>';