<?php
// 代码生成时间: 2025-08-12 07:10:17
class UrlValidator extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        // Load the necessary helper, library or model if needed
        // $this->load->helper('url');
    }

    /**
     * Validate a given URL
     *
     * @param string $url The URL to be validated
     * @return bool Returns true if the URL is valid, false otherwise
     */
    public function validate($url) {
        // Check if the URL is empty
        if (empty($url)) {
            // Log an error or handle it as required
            log_message('error', 'URL is empty.');
            return false;
        }

        // Use cURL to check if the URL is reachable
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        // Execute the cURL session and get the HTTP status code
        $response = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Check if the cURL operation was successful and the HTTP status code is 200
        if ($response !== false && $http_status === 200) {
            return true;
        }

        // If the URL is not reachable, log an error or handle it as required
        log_message('error', 'URL is not reachable or invalid.');
        return false;
    }

    /**
     * Example usage of the URL Validator
     *
     * This method can be called via a route to test the URL validator
     */
    public function test() {
        $url = 'http://example.com';
        $isValid = $this->validate($url);

        if ($isValid) {
            echo 'URL is valid.';
        } else {
            echo 'URL is invalid.';
        }
    }
}
