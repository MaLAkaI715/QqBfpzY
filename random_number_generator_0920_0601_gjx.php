<?php
// 代码生成时间: 2025-09-20 06:01:19
class RandomNumberGenerator {

    /**
     * Generate a random number within a specified range.
     *
     * @param int $min The minimum value of the range.
     * @param int $max The maximum value of the range.
     * @return int The generated random number.
     * @throws InvalidArgumentException If the range is invalid.
     */
    public function generate($min, $max) {
        // Check if the minimum value is less than or equal to the maximum value.
        if ($min > $max) {
            throw new InvalidArgumentException('Invalid range. Minimum value must be less than or equal to the maximum value.');
        }

        // Use mt_rand() for better randomness.
        return mt_rand($min, $max);
    }

}

// Example usage:
try {
    $generator = new RandomNumberGenerator();
    $min = 1;
    $max = 100;
    $randomNumber = $generator->generate($min, $max);
    echo "Random number between $min and $max: $randomNumber";
} catch (InvalidArgumentException $e) {
    // Handle the exception and display an error message.
    echo "Error: " . $e->getMessage();
}
