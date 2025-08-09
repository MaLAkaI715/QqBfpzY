<?php
// 代码生成时间: 2025-08-09 09:18:37
class TestDataGenerator {

    protected $ci;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct() {
        // Get the CodeIgniter super-object
        $this->ci =& get_instance();
    }

    /**
     * Generate test data
     *
     * @param array $data Fields to generate data for
     * @return array
     */
    public function generateData($data) {
        $result = [];

        foreach ($data as $field => $type) {
            switch ($type) {
                case 'string':
                    $result[$field] = $this->generateRandomString();
                    break;
                case 'integer':
                    $result[$field] = $this->generateRandomInteger();
                    break;
                case 'date':
                    $result[$field] = $this->generateRandomDate();
                    break;
                default:
                    // Handle unknown data type
                    $this->ci->log->write_log('error', 'Unknown data type: ' . $type);
                    break;
            }
        }

        return $result;
    }

    /**
     * Generate a random string
     *
     * @param int $length Length of the string
     * @return string
     */
    protected function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    /**
     * Generate a random integer
     *
     * @param int $min Minimum value
     * @param int $max Maximum value
     * @return int
     */
    protected function generateRandomInteger($min = 1, $max = 100) {
        return rand($min, $max);
    }

    /**
     * Generate a random date
     *
     * @param string $format Date format
     * @return string
     */
    protected function generateRandomDate($format = 'Y-m-d') {
        $timestamp = rand(strtotime('-1 year'), time());
        return date($format, $timestamp);
    }
}
