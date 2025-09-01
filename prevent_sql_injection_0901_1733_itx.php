<?php
// 代码生成时间: 2025-09-01 17:33:42
class PreventSqlInjection extends CI_Controller {

    /**
     * 构造函数
     *
     * 初始化数据库连接
     */
    public function __construct() {
        parent::__construct();

        // 加载数据库库
        $this->load->database();
    }

    /**
     * 演示防止SQL注入
     *
     * 这个函数演示了如何使用CodeIgniter的查询构建器来防止SQL注入。
     *
     * @param string $userInput 用户输入
     * @return void
     */
    public function index($userInput = '') {
        try {
            // 使用查询构建器来防止SQL注入
            $this->db->select('*')->from('users')->where('username', $userInput);
            $query = $this->db->get();

            // 检查查询结果
            if ($query->num_rows() > 0) {
                $user = $query->row_array();
                echo "用户找到：" . $user['username'];
            } else {
                echo '用户未找到';
            }
        } catch (Exception $e) {
            // 错误处理
            echo '数据库查询错误：' . $e->getMessage();
        }
    }
}
