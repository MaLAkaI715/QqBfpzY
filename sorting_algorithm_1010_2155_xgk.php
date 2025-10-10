<?php
// 代码生成时间: 2025-10-10 21:55:51
class SortingAlgorithm extends CI_Controller {

    /**
     * Constructor
     *
     * Loads the CodeIgniter framework and initializes the controller.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Bubble Sort
     *
     * Implements the bubble sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function bubbleSort($array) {
        if (!is_array($array)) {
            // Error handling: Input must be an array
            return 'Input must be an array.';
        }

        $n = count($array);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    // Swap the elements if they are in the wrong order
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $temp;
                }
            }
        }

        return $array;
    }

    /**
     * Quick Sort
     *
     * Implements the quick sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function quickSort($array) {
        if (!is_array($array)) {
            // Error handling: Input must be an array
            return 'Input must be an array.';
        }

        if (count($array) < 2) {
            // Base case: No need to sort an array with 0 or 1 elements
            return $array;
        }

        $pivot = $array[0];
        $left = $right = array();

        for ($i = 1; $i < count($array); $i++) {
            if ($array[$i] < $pivot) {
                $left[] = $array[$i];
            } else {
                $right[] = $array[$i];
            }
        }

        // Recursively sort the left and right sub-arrays
        $left = $this->quickSort($left);
        $right = $this->quickSort($right);

        // Combine the sorted sub-arrays with the pivot
        return array_merge($left, array($pivot), $right);
    }

    /**
     * Insertion Sort
     *
     * Implements the insertion sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function insertionSort($array) {
        if (!is_array($array)) {
            // Error handling: Input must be an array
            return 'Input must be an array.';
        }

        for ($i = 1; $i < count($array); $i++) {
            $key = $array[$i];
            $j = $i - 1;

            while ($j >= 0 && $array[$j] > $key) {
                $array[$j + 1] = $array[$j];
                $j--;
            }
            $array[$j + 1] = $key;
        }

        return $array;
    }
}
