<?php

function sockMerchant($n, $ar) {

    $pairsCount = 0;
    $pairs = [];
    foreach ($ar as $k => $color) {
        if (!isset($pairs[$color])) {
            $pairs[$color] = 0;
        }
        if (($pairs[$color]+1)%2==0) {
            $pairsCount++;
        }

        $pairs[$color]++;

        if ($pairsCount > ($n/2)) {
            break;
        }
    }

    return $pairsCount;
}

echo '<pre>';
print_r([
    '9, [10,20,20,10,10,30,50,10,20]' => sockMerchant(9, [10,20,20,10,10,30,50,10,20]), // Expected 3
    '10, [1,1,3,1,2,1,3,3,3,3]' => sockMerchant(10, [1,1,3,1,2,1,3,3,3,3]),             // Expected 4
    '30, [1,4,3,1,4,1,3,4,3,4,4,4,7,1,5,2,7,2,1,4,5,1,6,7,4,5,2,2,3,1]' => sockMerchant(30, [1,4,3,1,4,1,3,4,3,4,4,4,7,1,5,2,7,2,1,4,5,1,6,7,4,5,2,2,3,1]),   // Expected 13
]);
echo '</pre>';