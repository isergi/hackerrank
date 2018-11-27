<?php

function bubbleSort($arr)
{
    $arrSize = sizeOf($arr)-1;
    $isSorted = false;

    while (!$isSorted) {
        $isSorted = true;
        for ($i = 0; $i < $arrSize; $i++) {
            if ($arr[$i] > $arr[ $i+1 ]) {
                list($arr[ $i+1 ], $arr[$i]) = [$arr[$i], $arr[ $i+1 ]];
                $isSorted = false;
            }
        }
    }

    return $arr;
}

echo '<pre>';
$sortedArray = $arr = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
for ($i = 1; $i <= 13; $i ++) {
    shuffle($arr);
    $result = bubbleSort($arr);
    print_r([implode(',', $arr) => ($sortedArray == $result ? 'OK [' . implode(',', $sortedArray) . ']' : 'NO! [' . implode(',', $result) . ']')]);
}
echo '</pre>';
