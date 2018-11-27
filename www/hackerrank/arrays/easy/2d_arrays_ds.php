<?php

function hourglassSum($arr)
{
    $current = $max = -63;
    for ($i=1; $i<5; $i++) {
        for ($j=1; $j<5; $j++) {
            @$current = $arr[$i][$j] + $arr[$i-1][$j-1] + $arr[$i-1][$j] + $arr[$i-1][$j+1] + $arr[$i+1][$j-1] + $arr[$i+1][$j] + $arr[$i+1][$j+1];
            if ($max < $current) {
                $max = $current;
            }
        }
    }

    return $max;
}

echo '<pre>';
print_r(['[[1,1,1,0,0,0],
[0,1,0,0,0,0],
[1,1,1,0,0,],
[0,0,2,4,4,0],
[0,0,0,2,0,0],
[0,0,1,2,4,0]]' => hourglassSum(
    [[1,1,1,0,0,0],
    [0,1,0,0,0,0],
    [1,1,1,0,0,],
    [0,0,2,4,4,0],
    [0,0,0,2,0,0],
    [0,0,1,2,4,0]]
)]);
echo '</pre>';
