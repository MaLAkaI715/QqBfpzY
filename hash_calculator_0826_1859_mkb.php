<?php
// 代码生成时间: 2025-08-26 18:59:22
class HashCalculator extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load any necessary models or libraries
        // $this->load->model('model_name');
    }

    /**
     * Default method to calculate hash of given string
     *
     * @param string $algorithm
     * @param string $string
     * @return string|false
     */
    public function calculate($algorithm = 'md5', $string = '') {
        if (empty($string)) {
            // Return error if string is empty
            return $this->returnError('String to hash cannot be empty.');
        }

        // Check if the algorithm is supported
        if (!in_array($algorithm, hash_algos())) {
            return $this->returnError('Unsupported hash algorithm.');
        }

        // Calculate hash
        $hash = hash($algorithm, $string);
        if ($hash === false) {
            // Return error if hash calculation fails
            return $this->returnError('Failed to calculate hash.');
        }

        // Return the calculated hash
        return $hash;
    }

    /**
     * Helper method to return errors in a standardized format
     *
     * @param string $message
     * @return string
     */
    protected function returnError($message) {
        return json_encode(['error' => true, 'message' => $message]);
    }

}
