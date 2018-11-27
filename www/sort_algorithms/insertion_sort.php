<?php

function insertionSort($arr)
{
    $arrSize = sizeOf($arr)-1;

    for ($i = 1; $i <= $arrSize ; $i++) {
        $currentInsertion = $arr[$i];
        for ($j = $i - 1; $j >= 0; $j--) {
            if ($arr[$j] > $currentInsertion) {
                $arr[ $j + 1 ] = $arr[$j];
            } else {
                break;
            }
        }

        $arr[$j+1] = $currentInsertion;
    }
    return $arr;
}

echo '<pre>';
$sortedArray = $arr = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
for ($i = 1; $i <= 13; $i ++) {
    shuffle($arr);
    $result = insertionSort($arr);
    print_r([implode(',', $arr) => ($sortedArray == $result ? 'OK [' . implode(',', $sortedArray) . ']' : 'NO! [' . implode(',', $result) . ']')]);
}
echo '</pre>';
