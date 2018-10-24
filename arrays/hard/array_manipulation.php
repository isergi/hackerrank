<?php

// Complete the arrayManipulation function below.
function arrayManipulation($n, $queries) {
  $result = [];
  foreach ($queries as $query) {
      if (!isset($result[$query[0]])) {
          $result[$query[0]] = 0;
      }
      if (!isset($result[$query[1]+1])) {
        $result[$query[1]+1] = 0;
      }
      $result[$query[0]] += $query[2];
      $result[$query[1]+1] -= $query[2];
  }

  ksort($result);
  $sum = 0;
  $max = 0;
  foreach ($result as $count) {
      $sum += $count;
      if ($max < $sum) {
        $max = $sum;
      }
  }

  return $max;
}

echo '<pre>';
print_r(['10, [1,5,3],
         [4,8,7],
         [6,9,1]' => arrayManipulation(10, [
    [1,5,3],
    [4,8,7],
    [6,9,1]
  ])]);
print_r(['4, [2,3,603],
         [1,1,286],
         [4,4,882]' => arrayManipulation(4, [
      [2,3,603],
      [1,1,286],
      [4,4,882]
  ])]);
echo '</pre>';
echo '<pre>';
print_r(['10, [2,6,8],
         [3,5,7],
         [1,8,1],
         [5,9,15]' => arrayManipulation(10, [
      [2,6,8],
      [3,5,7],
      [1,8,1],
      [5,9,15]
  ])]);
echo '</pre>';
echo '<pre>';
print_r(['5, [1,2,100],
        [2,5,100],
        [3,4,100]' => arrayManipulation(5, [
    [1,2,100],
    [2,5,100],
    [3,4,100]
  ])]);
echo '</pre>';
