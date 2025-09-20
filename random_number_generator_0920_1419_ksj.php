<?php
// 代码生成时间: 2025-09-20 14:19:51
// RandomNumberGenerator.php
/**
 * Random Number Generator Controller
 * Generates random numbers within a specified range.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class RandomNumberGenerator extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        // Load necessary libraries
        $this->load->library('form_validation');
    }

    /**
     * Index method to generate a random number
     */
    public function index() {
        // Check if form submission is POST
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            // Validate the form input
            $this->form_validation->set_rules('range_min', 'Minimum Range', 'required|numeric');
            $this->form_validation->set_rules('range_max', 'Maximum Range', 'required|numeric');

            // Check if validation is successful
            if ($this->form_validation->run() === FALSE) {
                // Return error response
                $this->response(array(
                    'status' => FALSE,
                    'message' => 'Input validation failed.',
                    'errors' => $this->form_validation->error_array()
                ), REST_Controller::HTTP_BAD_REQUEST);
            } else {
                // Get the range values from the input
                $min = $this->input->post('range_min');
                $max = $this->input->post('range_max');

                // Generate a random number
                $random_number = $this->generate_random_number($min, $max);

                // Return success response
                $this->response(array(
                    'status' => TRUE,
                    'random_number' => $random_number
                ), REST_Controller::HTTP_OK);
            }
        } else {
            // Return bad request response
            $this->response(array(
                'status' => FALSE,
                'message' => 'Invalid request method.'
            ), REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Generates a random number within a specified range.
     *
     * @param int $min The minimum value of the range.
     * @param int $max The maximum value of the range.
     * @return int A random number within the specified range.
     */
    private function generate_random_number($min, $max) {
        // Check if the range is valid
        if ($min > $max) {
            // Return an error message
            return null;
        }

        // Use mt_rand for better randomness
        return mt_rand($min, $max);
    }

    /**
     * Prepares a JSON response.
     *
     * @param array $data The data to be returned.
     * @param int $http_code The HTTP response code.
     */
    private function response($data, $http_code) {
        $this->output
            ->set_status_header($http_code)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        exit;
    }
}
