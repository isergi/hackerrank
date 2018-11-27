<?php

// Complete the checkMagazine function below.
function sherlockAndAnagrams($s)
{
    $totalCount = 0;
    $strLength = strlen($s);
    $currentStr = str_split($s);
    foreach ($currentStr as $key => $value) {
        for ($i = 1; $i < $strLength - $key; ++$i) {
            $subStr = substr($s, $key, $i);
            $subLength = strlen($subStr);
            for ($j = $key + 1; $j <= $strLength - $subLength; ++$j) {
                if (count_chars($subStr, 1) == count_chars(substr($s, $j, $subLength), 1)) {
                    ++$totalCount;
                }
            }
        }
    }

    return $totalCount;
}

echo '<pre>';
print_r([
    'ifailuhkqq'     => sherlockAndAnagrams('ifailuhkqq'),   // Expected 3
    'abba'           => sherlockAndAnagrams('abba'),         // Expected 2
    'abcd'           => sherlockAndAnagrams('abcd'),         // Expected 0
    'kkkk'           => sherlockAndAnagrams('kkkk'),         // Expected 10
    'cdcd'           => sherlockAndAnagrams('cdcd'),         // Expected 5
]);
echo '</pre>';
