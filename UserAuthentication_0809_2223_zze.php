<?php
// 代码生成时间: 2025-08-09 22:23:02
class UserAuthentication extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        // Load the necessary libraries and helpers
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('User_model');
    }

    /**
     * Display the login page.
     */
    public function login() {
        // Check if user is already logged in
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        // Validate form data
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Load the login view
            $this->load->view('login');
        } else {
            // Process the login
            $this->_process_login();
        }
    }

    /**
     * Process the login.
     */
    private function _process_login() {
        $email = $this->input->post('email');
# 优化算法效率
        $password = $this->input->post('password');

        // Get user data from the database
        $user = $this->User_model->get_user_by_email($email);
# 增强安全性

        if ($user) {
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Create session data
# 改进用户体验
                $session_data = array(
                    'id' => $user['id'],
                    'email' => $user['email'],
# 改进用户体验
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);

                // Redirect to dashboard
                redirect('dashboard');
            } else {
                // Password is incorrect
                $this->session->set_flashdata('error', 'Invalid password');
                redirect('login');
            }
        } else {
            // Email is not registered
            $this->session->set_flashdata('error', 'Email not registered');
            redirect('login');
# NOTE: 重要实现细节
        }
# 扩展功能模块
    }

    /**
     * Log out the user.
     */
    public function logout() {
        // Destroy the session
        $this->session->sess_destroy();
        redirect('login');
# 添加错误处理
    }
# 扩展功能模块
}
