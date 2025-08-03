<?php
// 代码生成时间: 2025-08-04 05:03:47
 * This class provides an interface to sort arrays using different sorting algorithms.
 * It adheres to best practices for PHP and CodeIgniter development.
 */
class SortingAlgorithm {

    /**
     * Sorts an array using Bubble Sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function bubbleSort($array) {
        if (!is_array($array)) {
            // Error handling if input is not an array
            show_error('Input must be an array.');
        }

        $n = count($array);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    // Swap elements if they are in the wrong order
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $temp;
                }
            }
        }
        return $array;
    }

    /**
     * Sorts an array using Quick Sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function quickSort($array) {
        if (!is_array($array) || count($array) < 2) {
            // Error handling if input is not an array or has less than two elements
            show_error('Input must be an array with at least two elements.');
        }

        if (count($array) == 2) {
            return $array[0] < $array[1] ? $array : array_reverse($array);
        }

        $left = $right = array();
        $pivot = array_shift($array);

        foreach ($array as $item) {
            if ($item <= $pivot) {
                $left[] = $item;
            } else {
                $right[] = $item;
            }
        }

        return array_merge($this->quickSort($left), array($pivot), $this->quickSort($right));
    }

    // Additional sorting algorithms can be added here following the same pattern.

}

// Usage Example
$sortingAlgorithm = new SortingAlgorithm();
$unsortedArray = array(4, 2, 5, 3, 1);
$sortedArray = $sortingAlgorithm->quickSort($unsortedArray);
print_r($sortedArray);
