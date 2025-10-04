<?php
// 代码生成时间: 2025-10-04 22:15:44
defined('BASEPATH') OR exit('No direct script access allowed');
# 改进用户体验

class MiningPool extends CI_Controller {

    /**
     * Constructor
     */
# TODO: 优化性能
    public function __construct() {
        parent::__construct();
        \$this->load->model('MiningPoolModel'); // Load the model
        \$this->load->helper('url'); // Load URL helper for redirection
# TODO: 优化性能
    }

    
    /**
     * Display the mining pool dashboard
     */
    public function index() {
        \$data['mining_pools'] = \$this->MiningPoolModel->get_all_pools();
        \$this->load->view('mining_pools/index', \$data);
    }
    
    /**
# 扩展功能模块
     * Add a new mining pool
     */
    public function add() {
        \$this->form_validation->set_rules('name', 'Name', 'required');
# 添加错误处理
        \$this->form_validation->set_rules('capacity', 'Capacity', 'required|numeric');
        
        if (\$this->form_validation->run() == FALSE) {
# FIXME: 处理边界情况
            \$this->load->view('mining_pools/add');
        } else {
            \$this->MiningPoolModel->add_pool();
            redirect('mining_pool');
        }
    }
    
    /**
     * Edit an existing mining pool
     */
    public function edit(\$id) {
        \$pool = \$this->MiningPoolModel->get_pool_by_id(\$id);
# NOTE: 重要实现细节
        \$data['pool'] = \$pool;
        
        \$this->form_validation->set_rules('name', 'Name', 'required');
        \$this->form_validation->set_rules('capacity', 'Capacity', 'required|numeric');
        
        if (\$this->form_validation->run() == FALSE) {
            \$this->load->view('mining_pools/edit', \$data);
        } else {
# NOTE: 重要实现细节
            \$this->MiningPoolModel->update_pool(\$id);
            redirect('mining_pool');
        }
    }
    
    /**
     * Delete a mining pool
     */
    public function delete(\$id) {
        \$this->MiningPoolModel->delete_pool(\$id);
        redirect('mining_pool');
    }
}

/* End of file MiningPool.php */
/* Location: ./application/controllers/MiningPool.php */
# 添加错误处理
