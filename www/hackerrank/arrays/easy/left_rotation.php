<?php

function rotLeft($a, $d)
{
    $a1  = array_slice($a, 0, $d);
    $a2  = array_slice($a, $d, sizeOf($a));
    $a   = array_merge($a2, $a1);
    return $a;
}

echo '<pre>';
print_r(['[[1,2,3,4,5], 4]' => rotLeft([1,2,3,4,5], 4)]);
echo '</pre>';
