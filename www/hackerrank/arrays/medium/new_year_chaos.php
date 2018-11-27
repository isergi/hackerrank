<?php

// Complete the minimumBribes function below.
function minimumBribes($q)
{
    $stepsCount = 0;
    $bribesCounts = [];
    $arrayLength = sizeOf($q)-1;
    $swapCntPerRound = 0;
    for ($i = 0; $i < $arrayLength; $i++) {
        if ($q[$i] > $q[$i+1]) {
            if (!isset($bribesCounts[$q[$i]])) {
                $bribesCounts[$q[$i]] = 0;
            }

            $bribesCounts[$q[$i]]++;

            if ($bribesCounts[$q[$i]] > 2) {
                //echo 'Too chaotic', PHP_EOL;
                return "Too chaotic";
            }

            $stepsCount++;
            $swapCntPerRound++;
            list($q[$i+1], $q[$i]) = [$q[$i], $q[$i+1]];
        }

        if ($i == $arrayLength-1 && $swapCntPerRound > 0) {
            $i = -1;
            $swapCntPerRound = 0;
        }
    }

    //echo array_sum($bribesCounts), PHP_EOL;
    return array_sum($bribesCounts);
}

echo '<pre>';
print_r(['[2,1,5,3,4]' => minimumBribes([2,1,5,3,4])]);             // Expected 3
echo '</pre>';
echo '<pre>';
print_r(['[2,5,3,1,4]' => minimumBribes([2,5,3,1,4])]);             // Expected Too chaotic
echo '</pre>';
echo '<pre>';
print_r(['[5,1,2,3,7,8,6,4]' => minimumBribes([5,1,2,3,7,8,6,4])]); // Expected Too chaotic
echo '</pre>';
echo '<pre>';
print_r(['[1,2,5,3,7,8,6,4]' => minimumBribes([1,2,5,3,7,8,6,4])]); // Expected 7
echo '</pre>';
