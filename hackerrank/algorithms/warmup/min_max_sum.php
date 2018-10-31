<?php

// Complete the miniMaxSum function below.
function miniMaxSum($arr) {

    $min = min($arr);
    $max = max($arr);
    $totalSumm = array_sum($arr);
    
    /* 
        $totalSumm = 0;
        $min = $max = $arr[0];
        foreach ($arr as $v) {
        $totalSumm += $v;
        if ($min < $v) {
            $min = $v;
        }
        if ($max > $v) {
            $max = $v;
        }
    }
    */

    //return ($totalSumm - $min) . ' ' . ($totalSumm - $max);

    echo ($totalSumm - $min), ' ', ($totalSumm - $max);
}


echo '<pre>';
print_r([
    '[1,2,3,4,5]'                    => miniMaxSum([1,2,3,4,5]),                  // Expected 10 14
    '[10,20,20,10,10,30,50,10,20]'   => miniMaxSum([10,20,20,10,10,30,50,10,20]), // Expected 130 170
    '[1,1,3,1,2,1,3,3,3,3]'          => miniMaxSum([1,1,3,1,2,1,3,3,3,3]),        // Expected 18 20
    '[1,4,3,1,4,1,3]'                => miniMaxSum([1,4,3,1,4,1,3]),              // Expected 13 16
]);
echo '</pre>';