<?php
// 代码生成时间: 2025-08-14 21:18:14
class HashCalculatorTool extends CI_Controller
{
    /**
     * Construct the Hash Calculator Tool
     *
     * Initialize the CodeIgniter framework and load necessary libraries.
     */
    public function __construct()
    {
        parent::__construct();
        // Load the necessary libraries
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    /**
     * Index method for the Hash Calculator Tool
     *
     * Display the form for users to input their data and select the hash algorithm.
     */
    public function index()
    {
        // Set the validation rules for the input data
        $this->form_validation->set_rules('data', 'Data', 'required');
        $this->form_validation->set_rules('algorithm', 'Algorithm', 'required');

        // Check if the form is submitted and validated
        if ($this->form_validation->run() == FALSE)
        {
            // Load the view with validation errors
            $this->load->view('hash_calculator_view');
        }
        else
        {
            // Get the input data and algorithm from the form
            $data = $this->input->post('data');
            $algorithm = $this->input->post('algorithm');

            // Calculate the hash value
            $hash = $this->calculate_hash($data, $algorithm);

            // Display the result to the user
            $this->load->view('hash_result_view', ['hash' => $hash]);
        }
    }

    /**
     * Calculate the hash value for the given data and algorithm
     *
     * @param string $data The input data to calculate the hash for
     * @param string $algorithm The hash algorithm to use
     * @return string The calculated hash value
     */
    private function calculate_hash($data, $algorithm)
    {
        // Check if the algorithm is supported
        if (!in_array($algorithm, hash_algos()))
        {
            // Return an error message if the algorithm is not supported
            return 'Unsupported algorithm';
        }

        // Calculate the hash value using the specified algorithm
        return hash($algorithm, $data);
    }
}
