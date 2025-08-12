<?php
// 代码生成时间: 2025-08-13 02:47:17
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        // Load the necessary libraries
        $this->load->library('form_validation');
        $this->load->model('UserModel'); // Load UserModel for login
    }

    /**
     * Default method to display login form
     */
    public function index() {
        // Check if the user is already logged in
        if ($this->session->userdata('is_logged_in')) {
            redirect('dashboard'); // Redirect to dashboard
        }

        // Load the login view
        $this->load->view('login_view');
    }

    /**
     * Process the login form
     */
    public function login() {
        // Set validation rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // Check if the form is submitted and validated
        if ($this->form_validation->run() === FALSE) {
            // Load the login view with validation errors
            $this->load->view('login_view');
        } else {
            // Perform login validation
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->UserModel->validate_user($email, $password);

            if ($user) {
                // Create session data
                $session_data = array(
                    'is_logged_in' => TRUE,
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email
                );
                $this->session->set_userdata($session_data);

                // Redirect to dashboard
                redirect('dashboard');
            } else {
                // Set error message
                $this->session->set_flashdata('error', 'Invalid email or password');
                redirect('login');
            }
        }
    }

    /**
     * Log out the user
     */
    public function logout() {
        // Destroy the session data
        $this->session->sess_destroy();
        redirect('login');
    }
}
