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

print_r(sockMerchant(9, [10,20,20,10,10,30,50,10,20]));
