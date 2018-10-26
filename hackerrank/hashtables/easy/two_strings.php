<?php

// Complete the twoStrings function below.
function twoStrings($s1, $s2) {
    $s1Hash = str_split($s1);
    $s2Hash = str_split($s2);

    return (!empty(array_intersect($s1Hash, $s2Hash)) ? 'YES' : 'NO');
}


echo '<pre>';
print_r([
    '[hello, world]' => twoStrings('hello', 'world'),    // Expected YES
    '[hi, world]'    => twoStrings('hi', 'world'),       // Expected NO
]);
echo '</pre>';