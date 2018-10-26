<?php

class SwapCounter {
    private $_swaps = 0;
    private $_array = [];

    public function __construct($array) {
        $this->_array = $array;
    }

    public function getSwaps() {
        return $this->_swaps;
    }

    public function counSwaps() {
        $perRound = 500;
        do {
            $sorted = $this->_array;
            sort($sorted);
            $arraySize = sizeOf($sorted)-1;
            if ($arraySize > $perRound*2-1) {
                $arraySize = $perRound;
            }
            $i = 0;
            for ($i=0; $i < $arraySize; $i++) {
                $sorted[$i];
                if ($sorted[$i] != $this->_array[$i]) {
                    $keyToChange = array_search($sorted[$i], $this->_array);
                    list($this->_array[$i], $this->_array[$keyToChange]) = [$this->_array[$keyToChange], $this->_array[$i]];
                    $this->_swaps++;
                }
            }

            $this->_array = array_slice($this->_array, $perRound);

        } while (sizeOf($this->_array) > $perRound);
    }
}
// Complete the minimumSwaps function below.
function minimumSwaps($arr) {
    $swapCounter = new SwapCounter($arr);
    $swapCounter->counSwaps();
    return $swapCounter->getSwaps();
}

echo '<pre>';
print_r([
    '3,0,1,8,7,2,5,4,9,6'    => minimumSwaps([3,0,1,8,7,2,5,4,9,6]),                            // Expected 8
    '3,0,1,8,7,2,5,4,9,6,10'    => minimumSwaps([3,0,1,8,7,2,5,4,9,6,10]),                      // Expected 8
    '3,0,1,8,10,7,11,2,5,4,9,6'    => minimumSwaps([3,0,1,8,10,7,11,2,5,4,9,6]),                // Expected 9
    '12,3,13,0,1,8,10,7,11,2,5,4,9,6'    => minimumSwaps([12,3,13,0,1,8,10,7,11,2,5,4,9,6]),    // Expected 12
    '1,3,5,2,4,6,8'          => minimumSwaps([1,3,5,2,4,6,8]),                                  // Expected 3
    '4,3,1,2'                => minimumSwaps([4,3,1,2]),                                        // Expected 3
    '2,3,4,1,5'                => minimumSwaps([2,3,4,1,5]),                                    // Expected 3
    ]);
echo '</pre>';
