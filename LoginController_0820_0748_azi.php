<?php
// 代码生成时间: 2025-08-20 07:48:27
// LoginController.php
/**
 * 用户登录验证系统
 * 该控制器负责处理用户登录请求，并验证用户凭证。
 */
class LoginController extends CI_Controller {
    /**
     * 构造函数
     * 载入必要的库和模型
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('UserModel');
    }

    /**
     * 登录页面
     */
    public function index() {
        // 加载视图
        $this->load->view('login_view');
    }

    /**
     * 处理登录请求
     */
    public function authenticate() {
        // 设置表单验证规则
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        // 验证表单
        if ($this->form_validation->run() == FALSE) {
            // 验证失败，重新加载登录页面
            $this->load->view('login_view');
        } else {
            // 验证成功，获取用户输入
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // 调用模型进行用户验证
            $user = $this->UserModel->validate_user($email, $password);

            if ($user) {
                // 用户验证成功，设置会话数据
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('user_email', $user->email);

                // 重定向到首页
                redirect('home');
            } else {
                // 用户验证失败，设置错误消息并重新加载登录页面
                $this->session->set_flashdata('error', 'Invalid email or password');
                $this->load->view('login_view');
            }
        }
    }
}
