<?php
// 代码生成时间: 2025-09-17 04:37:14
 * It follows the PHP best practices and is designed for maintainability and extensibility.
 */
class TestDataGenerator {

    /**
     * Generate a random string for testing purposes.
     *
     * @param int $length The length of the string to generate.
     * @return string
     */
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    /**
     * Generate a random integer between two numbers.
     *
     * @param int $min The minimum value.
     * @param int $max The maximum value.
     * @return int
     */
    public function generateRandomInteger($min, $max) {
        if ($min > $max) {
            throw new Exception('Minimum value cannot be greater than maximum value.');
        }

        return rand($min, $max);
    }

    /**
     * Generate a random email address.
     *
     * @return string
     */
    public function generateRandomEmail() {
        $domain = 'example.com';
        return $this->generateRandomString(10) . '@' . $domain;
    }

    /**
     * Generate a random date within a specified range.
     *
     * @param string $startDate The start date in Y-m-d format.
     * @param string $endDate The end date in Y-m-d format.
     * @return string
     */
    public function generateRandomDate($startDate, $endDate) {
        $timestampMin = strtotime($startDate);
        $timestampMax = strtotime($endDate);

        if ($timestampMin > $timestampMax) {
            throw new Exception('Start date cannot be greater than end date.');
        }

        $randomTimestamp = rand($timestampMin, $timestampMax);
        return date('Y-m-d', $randomTimestamp);
    }

}
