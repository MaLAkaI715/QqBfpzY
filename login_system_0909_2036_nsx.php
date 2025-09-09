<?php
// 代码生成时间: 2025-09-09 20:36:57
class LoginController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('UserModel');
    }

    /**
     * 显示登录表单
     */
    public function index() {
        $this->load->view('login_view');
    }

    /**
     * 处理登录请求
     */
    public function login() {
        // 设置表单验证规则
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        // 执行表单验证
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login_view');
        } else {
            // 获取表单数据
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // 调用模型进行用户验证
            $user = $this->UserModel->validate_user($username, $password);

            if ($user) {
                // 设置用户会话
                $this->session->set_userdata('user_id', $user['id']);
                $this->session->set_userdata('username', $user['username']);

                // 重定向到首页
                redirect('home');
            } else {
                // 设置错误消息
                $this->session->set_flashdata('error', 'Invalid username or password');
                redirect('login');
            }
        }
    }
}

/* End of file LoginController.php */
/* Location: ./application/controllers/LoginController.php */