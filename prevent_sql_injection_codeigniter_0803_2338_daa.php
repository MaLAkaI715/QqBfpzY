<?php
// 代码生成时间: 2025-08-03 23:38:20
// 使用CodeIgniter框架防止SQL注入的示例程序

// 假设这是你的Model文件
class UserModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        // 加载数据库库
        $this->load->database();
    }

    // 获取用户列表函数，使用查询构建器防止SQL注入
    public function getUsers() {
        // 使用查询构建器
        $query = $this->db->get('users');
        // 返回查询结果
        return $query->result_array();
    }

    // 添加用户函数，防止SQL注入
    public function addUser($userData) {
        // 检查$data是否为数组
        if (!is_array($userData)) {
            return false; // 返回错误
        }

        // 插入数据
        $insert = $this->db->insert('users', $userData);
        // 返回插入结果
        return $insert ? $this->db->insert_id() : false;
    }

    // 更新用户函数，防止SQL注入
    public function updateUser($id, $userData) {
        // 检查$userData是否为数组
        if (!is_array($userData)) {
            return false; // 返回错误
        }

        // 更新数据
        $this->db->where('id', $id);
        $update = $this->db->update('users', $userData);
        // 返回更新结果
        return $update ? $update : false;
    }

    // 删除用户函数，防止SQL注入
    public function deleteUser($id) {
        // 删除数据
        $this->db->where('id', $id);
        $delete = $this->db->delete('users');
        // 返回删除结果
        return $delete ? $delete : false;
    }

}

// 以下是控制器文件，用于处理请求
class UserController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // 加载UserModel
        $this->load->model('UserModel');
    }

    public function index() {
        // 获取用户列表并传递给视图
        $data['users'] = $this->UserModel->getUsers();
        $this->load->view('users', $data);
    }

    public function addUser() {
        // 从POST数据中获取用户数据
        $userData = $this->input->post();
        // 添加用户
        $insertId = $this->UserModel->addUser($userData);
        // 检查添加结果
        if ($insertId) {
            // 添加成功
            echo 'User added successfully';
        } else {
            // 添加失败
            echo 'Failed to add user';
        }
    }

    public function updateUser() {
        // 从POST数据中获取用户数据和ID
        $id = $this->input->post('id');
        $userData = array('name' => $this->input->post('name'), 'email' => $this->input->post('email'));
        // 更新用户
        $updateSuccess = $this->UserModel->updateUser($id, $userData);
        // 检查更新结果
        if ($updateSuccess) {
            // 更新成功
            echo 'User updated successfully';
        } else {
            // 更新失败
            echo 'Failed to update user';
        }
    }

    public function deleteUser() {
        // 从POST数据中获取用户ID
        $id = $this->input->post('id');
        // 删除用户
        $deleteSuccess = $this->UserModel->deleteUser($id);
        // 检查删除结果
        if ($deleteSuccess) {
            // 删除成功
            echo 'User deleted successfully';
        } else {
            // 删除失败
            echo 'Failed to delete user';
        }
    }

}
