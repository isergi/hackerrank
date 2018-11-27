<?php

function mergeSort($arr)
{
    $arrSize = sizeOf($arr)-1;

    if ($arrSize < 1) {
        return $arr;
    }

    $middlePosition = round($arrSize / 2);

    $left = mergeSort(array_slice($arr, 0, $middlePosition));
    $right = mergeSort(array_slice($arr, $middlePosition));

    $result = [];
    
    while (!empty($left) && !empty($right)) {
        if ($left[0] < $right[0]) {
            $result[] = array_shift($left);
        } else {
            $result[] = array_shift($right);
        }
    }

    while (!empty($left)) {
        $result[] = array_shift($left);
    }

    while (!empty($right)) {
        $result[] = array_shift($right);
    }

    return $result;
}

echo '<pre>';
$sortedArray = $arr = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
for ($i = 1; $i <= 13; $i ++) {
    shuffle($arr);
    $result = mergeSort($arr);
    print_r([implode(',', $arr) => ($sortedArray == $result ? 'OK [' . implode(',', $sortedArray) . ']' : 'NO! [' . implode(',', $result) . ']')]);
}
echo '</pre>';
