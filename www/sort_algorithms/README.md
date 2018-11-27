Sorting algorithms using PHP
============================================================

## Selection sort

Selection sort has an outer loop and an inner loop. The outer loop starts from the first element to the pre-last element of the end, because when it gets to the element right before the last element, the last element should be in its correct position. The inner loop starts from the next of current index of the outer loop to the end of the list. When the inner loop finishes, it will swap the current index of the outer loop with the next maximum value.

## Insertion sort

Insertion sort has one outer loop and one inner loop. The first element in the list is considered sorted, thus, the outer loop starts from the second element to the end of the list. The inner loop starts from the current index-1 of the outer loop, and going backwards of the already sorted list until index 0 and inserts the value of the current outer index to the correct position of the already sorted elements. Each outer loop will increase the number of already sorted elements by 1, since each outer loop will insert the next element into the correct position of the already sorted elements.

## Quick Sort

A simple quicksort creates two empty arrays to hold elements less than the pivot value and elements greater than the pivot value, this will require O(n) extra storage space, which will impact the speed and efficiency particularly when the input is large.

## Merge Sort

Merge Sort is a divide and conquer algorithm and it produce a stable sort which means that the implementation preserves the input order of equal elements in the sorted output. It is O(n log n).

- Divide the unsorted list into n sublists, each containing 1 element (a list of 1 element is considered sorted).
- Repeatedly merge sublists to produce new sorted sublists until there is only 1 sublist remaining. This will be the sorted list.

## Heap Sort

**Array based representation for Binary Heap?**
Since a Binary Heap is a Complete Binary Tree, it can be easily represented as array and array based representation is space efficient. If the parent node is stored at index I, the left child can be calculated by 2 * I + 1 and right child by 2 * I + 2 (assuming the indexing starts at 0).

**Heap Sort Algorithm for sorting in increasing order:**
1. Build a max heap from the input data.
2. At this point, the largest item is stored at the root of the heap. Replace it with the last item of the heap followed by reducing the size of heap by 1. Finally, heapify the root of tree.
3. Repeat above steps while size of heap is greater than 1.

## Shell sort

Later ....

## Bubble sort

Bubble sort, as the name suggests, it bubbles up the element to the correct position each time it loops through the element list. For example, to sort the list in ascending order and the loop starts from index 0. The first loop will move the largest element to the end of the list, second loop will move the largest element in the remaining list to the second position of the end of the list. Before going through the loop, we will check a boolean variable(isSwapped), and starts the loop only if it is true. The first line of the loop will set isSwapped to false, it will be marked to true if there is a swap between elements. If there is no swaps, then the list is sorted. There will be a outer while loop checks if isSwapped is true, if it is true, then starts the inner loop to swap adjacent elements as needed. It compares A(index 0) and B(index 1), if A is greater than B, swap them. Then compares A(now index 1) and C(index 2), if A is greater than C, swap. Then compares A(now index 2) and D(index 3), if A is greater than D, swap, assume this time it is not greater than D, no swaps. Then compares D(index 3) and E(index 4), if D is greater than E, swap. Keep doing this until the end of unsorted elements.

## Cocktail shaker sort

Later ....

## Gnome sort

Later ....

## Bitonic sort

Later ....

## Bogo sort

Later ....