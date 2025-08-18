<?php
// 代码生成时间: 2025-08-18 14:24:01
// user_permission_system.php
// 这是一个使用CodeIgniter框架的用户权限管理系统

defined('BASEPATH') OR exit('No direct script access allowed');

class UserPermissionSystem extends CI_Controller {

    // 构造函数
    public function __construct() {
        parent::__construct();
        // 加载模型和帮助器
        $this->load->model('UserPermissionModel');
        $this->load->helper('url_helper');
    }

    // 显示用户权限列表
    public function index() {
        // 获取用户权限数据
        $data['permissions'] = $this->UserPermissionModel->get_permissions();

        // 加载视图
        $this->load->view('user_permissions', $data);
    }

    // 添加新权限
    public function add_permission() {
        // 检查表单提交
        if ($this->input->post()) {
            // 表单验证
            $this->form_validation->set_rules('permission_name', 'Permission Name', 'required');
            if ($this->form_validation->run() === FALSE) {
                // 验证失败，显示错误消息
                $this->load->view('add_permission_form');
            } else {
                // 验证成功，添加权限
                $this->UserPermissionModel->add_permission($this->input->post('permission_name'));
                // 重定向到权限列表页面
                redirect('user_permission_system/index');
            }
        } else {
            // 显示添加权限表单
            $this->load->view('add_permission_form');
        }
    }

    // 编辑权限
    public function edit_permission($id) {
        if ($this->input->post()) {
            // 表单验证
            $this->form_validation->set_rules('permission_name', 'Permission Name', 'required');
            if ($this->form_validation->run() === FALSE) {
                // 验证失败，显示错误消息
                $data['permission'] = $this->UserPermissionModel->get_permission($id);
                $this->load->view('edit_permission_form', $data);
            } else {
                // 验证成功，更新权限
                $this->UserPermissionModel->update_permission($id, $this->input->post('permission_name'));
                // 重定向到权限列表页面
                redirect('user_permission_system/index');
            }
        } else {
            // 显示编辑权限表单
            $data['permission'] = $this->UserPermissionModel->get_permission($id);
            $this->load->view('edit_permission_form', $data);
        }
    }

    // 删除权限
    public function delete_permission($id) {
        // 删除权限
        $this->UserPermissionModel->delete_permission($id);
        // 重定向到权限列表页面
        redirect('user_permission_system/index');
    }
}

class UserPermissionModel extends CI_Model {

    // 获取所有权限
    public function get_permissions() {
        $query = $this->db->get('permissions');
        return $query->result();
    }

    // 添加权限
    public function add_permission($name) {
        $data = array(
            'name' => $name
        );
        $this->db->insert('permissions', $data);
    }

    // 获取单个权限
    public function get_permission($id) {
        $query = $this->db->get_where('permissions', array('id' => $id));
        return $query->row();
    }

    // 更新权限
    public function update_permission($id, $name) {
        $data = array(
            'name' => $name
        );
        $this->db->where('id', $id);
        $this->db->update('permissions', $data);
    }

    // 删除权限
    public function delete_permission($id) {
        $this->db->where('id', $id);
        $this->db->delete('permissions');
    }
}
