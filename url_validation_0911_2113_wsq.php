<?php
// 代码生成时间: 2025-09-11 21:13:34
class UrlValidation extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    /**
     * Validate a URL
     * @param string $url The URL to validate
     * @return bool Whether the URL is valid or not
     */
    public function validate($url = '') {
        // Check if URL is provided
        if (empty($url)) {
            $this->response(false, 'URL is required.');
            return;
        }

        // Set validation rule
        $this->form_validation->set_rules('url', 'URL', 'required|valid_url');

        // Validate the URL
        if ($this->form_validation->run() === FALSE) {
            $this->response(false, 'Invalid URL.');
        } else {
            $this->response(true, 'URL is valid.');
        }
    }

    /**
     * Response method to return JSON output
     * @param bool $status Whether the operation was successful
     * @param string $message The message to return
     */
    private function response($status, $message) {
        header('Content-Type: application/json');
        echo json_encode(array(
            'status' => $status,
            'message' => $message
        ));
    }

    /**
     * Index method
     * @param string $url The URL to validate
     */
    public function index($url = '') {
        $this->validate($url);
    }
}
