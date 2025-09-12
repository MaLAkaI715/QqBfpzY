<?php
// 代码生成时间: 2025-09-12 12:47:18
class RandomGenerator {
    /**
     * Generate a random number between two numbers.
     * 
     * @param int $min The minimum value of the range.
     * @param int $max The maximum value of the range.
     * @return int The generated random number.
     * @throws Exception If the minimum value is greater than the maximum value.
     */
    public function generateRandomNumber($min, $max) {
        // Validate input to ensure min is less than max
        if ($min > $max) {
            throw new Exception('Minimum value cannot be greater than maximum value.');
        }

        // Generate a random number between min and max
        return rand($min, $max);
    }
}
