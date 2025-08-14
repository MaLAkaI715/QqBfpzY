<?php
// 代码生成时间: 2025-08-14 12:14:44
class RandomNumberGenerator extends CI_Controller {

    /**
     * Generate a random number
     *
     * @param int $min Minimum value of the random number
     * @param int $max Maximum value of the random number
     * @return void
     */
    public function generate($min = 0, $max = 100) {
        // Check if the provided values are valid
        if (!is_numeric($min) || !is_numeric($max)) {
            // Set an error message if the input is not numeric
            $this->session->set_flashdata('error', 'Invalid input. Please provide numeric values.');
            redirect('random_number_generator');
        }

        // Check if the minimum value is less than the maximum value
        if ($min >= $max) {
            // Set an error message if the minimum is not less than the maximum
            $this->session->set_flashdata('error', 'Minimum value must be less than maximum value.');
            redirect('random_number_generator');
        }

        // Generate a random number between the provided range
        $randomNumber = rand($min, $max);

        // Load the view and pass the random number to it
        $data['random_number'] = $randomNumber;
        $this->load->view('random_number_view', $data);
    }
}

/**
 * Random Number View
 * This view displays the generated random number.
 */

/**
 * Random Number Generator Router
 * This route directs all requests to the generate method of the RandomNumberGenerator controller.
 */
$route['random_number'] = 'random_number_generator/generate/';