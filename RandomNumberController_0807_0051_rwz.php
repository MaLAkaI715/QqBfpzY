<?php
// 代码生成时间: 2025-08-07 00:51:34
defined('BASEPATH') OR exit('No direct script access allowed');

// RandomNumberController.php
class RandomNumberController extends CI_Controller {

    /**
     * Generate a random number within the given range.
     *
     * @param int $min Minimum value in the range.
     * @param int $max Maximum value in the range.
     * @return void
     */
    public function generate($min = 0, $max = 100) {
        // Check if the range is valid
        if ($min > $max) {
            $this->session->set_flashdata('error', 'Minimum value cannot be greater than maximum value.');
            redirect('random_number_controller/generate');
            return;
        }

        // Generate a random number within the specified range
        $randomNumber = mt_rand($min, $max);

        // Load the view and pass the random number to it
        $data = array(
            'random_number' => $randomNumber,
        );
        $this->load->view('random_number_view', $data);
    }

    /**
     * Default method to display the form for generating random numbers.
     *
     * @return void
     */
    public function index() {
        // Load the view for the form
        $this->load->view('random_number_form_view');
    }
}
