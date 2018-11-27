<?php

class Heap
{
    private $_arr = [];
    
    public function setArray(array $arr)
    {
        $this->_arr = $arr;
    }

    public function getArray()
    {
        return $this->_arr;
    }

    public function __construct(array $arr = [])
    {
        $this->setArray($arr);
    }

    public function doSort()
    {
        $arrSize = sizeOf($this->_arr);
        for ($i = ceil(($arrSize / 2)) + 1; $i >= 0; $i--) {
            $this->_buildHeap($arrSize, $i);
        }
        
        for ($i = $arrSize - 1; $i >= 0; $i--) {
            list($this->_arr[0], $this->_arr[$i]) = [$this->_arr[$i], $this->_arr[0]];
            $this->_buildHeap($i, 0);
        }
    }

    private function _buildHeap($arrSize, $pos)
    {
        $maxHeaph = $pos;
        $left = $pos*2 + 1;
        $right = $pos*2 + 2;
    
        if ($left < $arrSize && $this->_arr[$left] > $this->_arr[$maxHeaph]) {
            $maxHeaph = $left;
        }
    
        if ($right < $arrSize && $this->_arr[$right] > $this->_arr[$maxHeaph]) {
            $maxHeaph = $right;
        }

        if ($maxHeaph != $pos) {
            list($this->_arr[$pos], $this->_arr[$maxHeaph]) = [$this->_arr[$maxHeaph], $this->_arr[$pos]];
            $this->_buildHeap($arrSize, $maxHeaph);
        }
    }
}

$heapSort = new Heap();
echo '<pre>';
$sortedArray = $arr = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
for ($i = 1; $i <= 13; $i ++) {
    shuffle($arr);
    $heapSort->setArray($arr);
    $heapSort->doSort();
    $result = $heapSort->getArray();
    print_r([implode(',', $arr) => ($sortedArray == $result ? 'OK [' . implode(',', $sortedArray) . ']' : 'NO! [' . implode(',', $result) . ']')]);
}
echo '</pre>';
