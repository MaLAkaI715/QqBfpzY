<?php
// 代码生成时间: 2025-10-13 02:58:34
// 数字银行平台的主要控制器文件
class DigitalBankController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // 加载数据库和表单验证类
        $this->load->database();
# 添加错误处理
        $this->load->library('form_validation');
    }

    // 用户登陆
    public function login() {
        $this->load->view('login_view');
    }

    // 用户注册
    public function register() {
# TODO: 优化性能
        $this->load->view('register_view');
    }
# FIXME: 处理边界情况

    // 用户登出
    public function logout() {
        $this->session->unset_userdata('user_id');
        redirect('login');
    }

    // 处理用户登陆
    public function process_login() {
        // 设置表单验证规则
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->login();
# TODO: 优化性能
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user_id = $this->User_model->login($username, $password);

            if ($user_id) {
                $this->session->set_userdata('user_id', $user_id);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password');
                redirect('login');
            }
        }
    }

    // 处理用户注册
    public function process_register() {
        // 设置表单验证规则
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->register();
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->User_model->register($username, $password);
            $this->session->set_flashdata('success', 'Registration successful');
            redirect('login');
# NOTE: 重要实现细节
        }
    }

    // 用户仪表板
# NOTE: 重要实现细节
    public function dashboard() {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        $this->load->view('dashboard_view');
    }

}

// 用户模型类，处理用户相关的业务逻辑
class User_model extends CI_Model {

    public function login($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            return $query->row()->id;
        } else {
            return false;
        }
# 改进用户体验
    }

    public function register($username, $password) {
        $data = array(
            'username' => $username,
            'password' => md5($password)
        );
        return $this->db->insert('users', $data);
    }

}
