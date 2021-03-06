<?php

function selectionSort($arr)
{
    $arrSize = sizeOf($arr)-1;

    for ($i = 0; $i < $arrSize ; $i++) {
        $maxPos = $i;
        for ($j = $i+1; $j <= $arrSize; $j++) {
            if ($arr[$j] < $arr[$maxPos]) {
                $maxPos = $j;
            }
        }

        list($arr[$maxPos], $arr[$i]) = array($arr[$i], $arr[$maxPos]);
    }
    return $arr;
}

echo '<pre>';
$sortedArray = $arr = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
for ($i = 1; $i <= 13; $i ++) {
    shuffle($arr);
    $result = selectionSort($arr);
    print_r([implode(',', $arr) => ($sortedArray == $result ? 'OK [' . implode(',', $sortedArray) . ']' : 'NO! [' . implode(',', $result) . ']')]);
}
echo '</pre>';
