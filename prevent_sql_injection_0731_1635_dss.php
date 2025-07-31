<?php
// 代码生成时间: 2025-07-31 16:35:20
class PreventSqlInjection extends CI_Controller {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
        $this->load->database(); // 加载数据库
    }

    /**
     * 展示防止SQL注入的示例
     */
    public function index() {
        // 获取用户输入
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // 检查输入是否为空
        if (empty($username) || empty($password)) {
            $this->load->view('error_view', ['error' => '用户名或密码不能为空']);
            return;
        }

        // 使用CodeIgniter的数据库活动记录器防止SQL注入
        $this->db->select('id, username, password');
        $this->db->from('users');
        $this->db->where('username', $this->db->escape_str($username));
        $this->db->where('password', $this->db->escape_str($password));

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $user = $query->row_array();
            // 进行登录逻辑处理
            $this->load->view('success_view', ['user' => $user]);
        } else {
            $this->load->view('error_view', ['error' => '用户名或密码错误']);
        }
    }
}
