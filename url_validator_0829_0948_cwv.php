<?php
// 代码生成时间: 2025-08-29 09:48:19
// URL Validator Class
class UrlValidator {

    private $ci;

    // Constructor to initialize CodeIgniter instance
    public function __construct() {
        \$this->ci =& get_instance();
    }

    // Function to validate URL
    public function validate($url) {
        // Check if the URL is empty
        if (empty($url)) {
            return false;
        }

        // Use filter_var to validate the URL
        if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
            return true;
        } else {
            // Log error if URL is invalid
            \$this->ci->load->helper('log_helper');
            log_error('Invalid URL: ' . $url);
            return false;
        }
    }

    // Function to check if URL is reachable
    public function isReachable($url) {
        if (!\$this->validate($url)) {
            return false;
        }

        // Use cURL to check if the URL is reachable
        \$ch = curl_init($url);
        curl_setopt(\$ch, CURLOPT_NOBODY, true);
        curl_setopt(\$ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt(\$ch, CURLOPT_RETURNTRANSFER, true);
        \$response = curl_exec(\$ch);
        curl_close(\$ch);

        // Return true if the URL is reachable, false otherwise
        return ($response !== false);
    }
}
