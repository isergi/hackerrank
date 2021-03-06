<?php

function jumpingOnClouds($c)
{
    $pathSize = sizeOf($c);
    $currentPos = 0;
    $minimalSteps = 0;
    while ($currentPos < $pathSize-1) {
        $currentPos += (isset($c[$currentPos+2]) && (($c[$currentPos+2]) == 0) ? 2 : 1);
        $minimalSteps++;
    }
    return $minimalSteps;
}

echo '<pre>';
print_r(
[
    '0 0 1 0 0 1 0'          => jumpingOnClouds([0,0,1,0,0,1,0]),        // Expected 4
    '0 0 0 1 0 0'            => jumpingOnClouds([0,0,0,1,0,0]),          // Expected 3
    '0 1 0 1 0 0 1 0 1 0'    => jumpingOnClouds([0,1,0,1,0,0,1,0,1,0]),  // Expected 5
    '0 0 0 0 1 0'            => jumpingOnClouds([0,0,0,0,1,0])           // Expected 3
]
);
echo '</pre>';
