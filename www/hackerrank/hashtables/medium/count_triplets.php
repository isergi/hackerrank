<?php

// Complete the checkMagazine function below.
function countTriplets($arr, $r)
{
    $totalTriplets = 0;
    $arrayLength = sizeOf($arr);

    $used = [];
    $valuesCounts = array_count_values($arr);

    for ($i = 0; $i < $arrayLength-1; $i++) {
        $valuesCounts[ $arr[$i] ]--;
        if (!isset($used[ $arr[$i] ])) {
            $used[ $arr[$i] ] = 0;
        }
        if (isset($valuesCounts[ $arr[$i]*$r ]) && isset($valuesCounts[ $arr[$i]/$r ])) {
            $totalTriplets += $valuesCounts[ $arr[$i]*$r ] * $used[ $arr[$i]/$r ];
        }
        $used[ $arr[$i] ]++;
    }

    return $totalTriplets;
}

echo '<pre>';
print_r([
      '[1 3 9 3 9 9 27], 3' => countTriplets([1,3,9,3,9,9,27], 3),   // Expected 10
    // '[1 3 9 9 27 81], 3' => countTriplets([1,3,9,9,27,81], 3),    // Expected 6
      '[1 1 3 9], 3' => countTriplets([1,1,3,9], 3),                 // Expected 2
      '[1 5 5 25 125], 5' => countTriplets([1,5,5,25,125], 5),       // Expected 4
      '[1,1,1,1], 1' => countTriplets([1,1,1,1,1,1,1,1,1,1,], 1),    // Expected 120
]);
echo '</pre>';
