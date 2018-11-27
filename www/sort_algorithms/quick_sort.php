<?php

function quickSort($arr)
{
    $arrSize = sizeOf($arr)-1;

    if ($arrSize > 0) {
        $currentElement = $arr[0];
        $rightElements = $leftElements = [];

        for ($i = 1; $i <= $arrSize; $i++) {
            if ($arr[$i] < $currentElement) {
                $leftElements[] = $arr[$i];
            } else {
                $rightElements[] = $arr[$i];
            }
        }

        return array_merge(quickSort($leftElements), [$currentElement], quickSort($rightElements));
    }

    return $arr;
}

echo '<pre>';
$sortedArray = $arr = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
for ($i = 1; $i <= 13; $i ++) {
    shuffle($arr);
    $result = quickSort($arr);
    print_r([implode(',', $arr) => ($sortedArray == $result ? 'OK [' . implode(',', $sortedArray) . ']' : 'NO! [' . implode(',', $result) . ']')]);
}
echo '</pre>';
