<?php
/*
 * Sort the given array using selection sort
 */

function selectionSort($arr) {
    $n = count($arr);

    for ($i = 0; $i < $n - 1; $i++) {
        // Find the index of the minimum element in the unsorted part of the array
        $minIndex = $i;
        for ($j = $i + 1; $j < $n; $j++) {
            if ($arr[$j] < $arr[$minIndex]) {
                $minIndex = $j;
            }
        }

        // Swap the minimum element with the first element of the unsorted part
        $temp = $arr[$i];
        $arr[$i] = $arr[$minIndex];
        $arr[$minIndex] = $temp;
    }

    return $arr;
}

// Example usage:

$arr = [64, 25, 12, 22, 11, 90];
echo "Original array: " . implode(", ", $arr) . "\n";
$sortedArr = selectionSort($arr);
echo "Sorted array: " . implode(", ", $sortedArr) . "\n";
