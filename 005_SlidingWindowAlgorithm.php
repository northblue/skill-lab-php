<?php
/*
 * using the sliding window algorithm to find the maximum sum of a subarray of length
 * $k in a given array $nums
 */

function maxSubArray($nums, $k)
{
    $windowSum = 0;
    $count = count($nums);
    if($count< $k) {
        // given length is greater than the length of the array
        return -1;
    }
    for($i=0; $i<$k; $i++) {
        $windowSum += $nums[$i];
    }
    $max = $windowSum;
    for($i=1; $i<=$count-$k; $i++) {
        $windowSum = $windowSum - $nums[$i-1]+$nums[$i+$k-1];
        $max = max($max, $windowSum);
    }
    return $max;
}

$nums = [1, 4, 2, 10, 2, 3, 1, 0, 20,2];
$k = 3;
$maxSum = maxSubArray($nums, $k);
echo "Maximum sum of subarray of length $k is: $maxSum";