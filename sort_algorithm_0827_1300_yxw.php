<?php
// 代码生成时间: 2025-08-27 13:00:16
 * It includes basic error handling and follows best practices for maintainability and scalability.
 */
class SortAlgorithm {

    /**
     * Bubble Sort implementation
     *
     * @param array $arr The array to be sorted.
     * @return array The sorted array.
     */
    public function bubbleSort(array $arr): array {
        if (empty($arr)) {
            // Return an empty array if input is empty.
            return [];
        }

        $n = count($arr);
        for ($i = 0; $i < $n; $i++) {
            for ($j = 1; $j < ($n - $i); $j++) {
                if ($arr[$j - 1] > $arr[$j]) {
                    // Swap elements if they are in the wrong order.
                    $temp = $arr[$j - 1];
                    $arr[$j - 1] = $arr[$j];
                    $arr[$j] = $temp;
                }
            }
        }

        return $arr;
    }

    /**
     * Quick Sort implementation
     *
     * @param array $arr The array to be sorted.
     * @return array The sorted array.
     */
    public function quickSort(array $arr): array {
        if (empty($arr) || count($arr) < 2) {
            // Return the array if it is already sorted or has less than 2 elements.
            return $arr;
        }

        $left = $right = [];
        $pivot = array_shift($arr);

        foreach ($arr as $value) {
            if ($value < $pivot) {
                $left[] = $value;
            } else {
                $right[] = $value;
            }
        }

        return array_merge($this->quickSort($left), [$pivot], $this->quickSort($right));
    }

    /**
     * Insertion Sort implementation
     *
     * @param array $arr The array to be sorted.
     * @return array The sorted array.
     */
    public function insertionSort(array $arr): array {
        foreach ($arr as $i => $value) {
            $j = $i - 1;

            while ($j >= 0 && $arr[$j] > $value) {
                $arr[$j + 1] = $arr[$j];
                $j--;
            }

            $arr[$j + 1] = $value;
        }

        return $arr;
    }

    // Additional sorting algorithms can be added here following the same pattern.

}
