<?php
// 代码生成时间: 2025-08-02 07:03:21
class Authentication extends CI_Controller {

    /**
     * Constructor
     *
     * Loads the necessary libraries and helpers.
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('security');
    }

    /**
     * Login action
     *
     * Handles user login.
     */
    public function login() {
        // Validate form input
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

        if ($this->form_validation->run() === FALSE) {
            // Form validation failed
            $this->load->view('login_view');
        } else {
            // Form validation passed
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // Authenticate user
            $user = $this->User_model->authenticate_user($email, $password);

            if ($user) {
                // User authenticated
                $this->session->set_userdata('user_id', $user->id);
                redirect('dashboard');
            } else {
                // Authentication failed
                $this->session->set_flashdata('error', 'Invalid email or password.');
                redirect('login_view');
            }
        }
    }

    /**
     * Logout action
     *
     * Handles user logout.
     */
    public function logout() {
        // Destroy user session
        $this->session->sess_destroy();

        // Redirect to login page
        redirect('login_view');
    }
}

/**
 * User Model
 *
 * This model handles user-related operations.
 */
class User_model extends CI_Model {

    /**
     * Authenticate user
     *
     * Checks if the provided email and password are valid.
     *
     * @param string $email User email
     * @param string $password User password
     *
     * @return mixed User object if authentication is successful, false otherwise
     */
    public function authenticate_user($email, $password) {
        // Retrieve user by email
        $user = $this->db->get_where('users', array('email' => $email))->row();

        if ($user && password_verify($password, $user->password)) {
            // Password matches
            return $user;
        } else {
            // Authentication failed
            return false;
        }
    }
}
