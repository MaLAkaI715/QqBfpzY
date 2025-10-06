<?php
// 代码生成时间: 2025-10-06 22:10:48
defined('BASEPATH') OR exit('No direct script access allowed');

// 导入必要的库和助手函数
use CI_Controller;
use CI_Model;
use CI_DB;
use CI_Loader;
use CI_Input;
use CI_Session;
use CI_Form_validation;

class HealthMonitorService extends CI_Controller {
    // 构造函数
    public function __construct() {
        parent::__construct();
        // 加载数据库和表单验证库
        $this->load->database();
        $this->load->library('form_validation');
        // 加载模型
        $this->load->model('HealthMonitorModel');
    }

    // 首页路由
    public function index() {
        // 检测是否登录
        if (!$this->session->userdata('is_logged_in')) {
            redirect('login');
        }
        // 获取健康数据
        $data['health_data'] = $this->HealthMonitorModel->getHealthData();
        // 加载视图
        $this->load->view('health_monitor/index', $data);
    }

    // 提交健康数据
    public function submitHealthData() {
        // 设置表单验证规则
        $this->form_validation->set_rules('heart_rate', 'Heart Rate', 'required');
        $this->form_validation->set_rules('blood_pressure', 'Blood Pressure', 'required');
        // 进行表单验证
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('health_monitor/submit_health_data');
        } else {
            // 插入健康数据
            $this->HealthMonitorModel->insertHealthData();
            // 重定向到首页
            redirect('health_monitor_service');
        }
    }
}

class HealthMonitorModel extends CI_Model {
    // 获取健康数据
    public function getHealthData() {
        // 查询数据库
        $query = $this->db->get('health_data');
        return $query->result();
    }

    // 插入健康数据
    public function insertHealthData() {
        // 获取表单数据
        $data = array(
            'heart_rate' => $this->input->post('heart_rate'),
            'blood_pressure' => $this->input->post('blood_pressure')
        );
        // 插入数据到数据库
        $this->db->insert('health_data', $data);
    }
}
