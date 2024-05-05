<?php

/*
 * Sort the given array using bubble sort
 */
function bubbleSort($arr) {
    $n = count($arr);
    for($i=0; $i< $n -1; $i++) {
        for($j=$i+1; $j<$n; $j++) {
            if($arr[$i]< $arr[$j]) {
                $temp = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $temp;
            }
        }
    }
    return $arr;
}

// Example usage:
$arr = [64, 34, 25, 12, 22, 11, 90];
echo "Original array: " . implode(", ", $arr) . "\n";
$sortedArr = bubbleSort($arr);
echo "Sorted array: " . implode(", ", $sortedArr) . "\n";