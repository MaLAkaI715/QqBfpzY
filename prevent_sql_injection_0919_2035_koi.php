<?php
// 代码生成时间: 2025-09-19 20:35:50
class PreventSqlInjection extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // 加载数据库库
        $this->load->database();
    }

    /**
     * 显示一个表单，用户可以输入搜索条件
     */
    public function index() {
        $this->load->view('search_form');
    }

    /**
     * 处理表单提交，防止SQL注入
     *
     * @param string $searchTerm 用户输入的搜索条件
     */
    public function search($searchTerm = '') {
        try {
            // 使用查询构造器来构建安全的查询
            $this->db->select('*');
            $this->db->from('users');
            $this->db->like('username', $this->db->escape_str($searchTerm));
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                // 显示结果
                $data['results'] = $query->result();
                $this->load->view('results', $data);
            } else {
                // 没有找到匹配的用户
                $this->load->view('no_results');
            }
        } catch (Exception $e) {
            // 错误处理
            log_message('error', 'Search failed: ' . $e->getMessage());
            $this->load->view('error');
        }
    }
}

/*
 * 数据库配置和路由配置应该在CodeIgniter的配置文件中设置
 * 例如：application/config/database.php 和 application/config/routes.php
 */
