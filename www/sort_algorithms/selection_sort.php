<?php

function selectionSort($arr) {
    
    $arrSize = sizeOf($arr)-1;
    echo $arrSize;
    die();
    return $arr;
}

echo '<pre>';
print_r(['[1,2,4,3,5]' => selectionSort([1,2,4,3,5])]);
echo '</pre>';