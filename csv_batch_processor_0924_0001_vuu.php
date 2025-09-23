<?php
// 代码生成时间: 2025-09-24 00:01:36
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/CSVReader.php';

class CsvBatchProcessor extends CI_Controller {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('csvreader');
        $this->load->helper('file');
    }

    /**
     * 处理CSV文件
     *
     * @param string $file_path CSV文件路径
     * @return void
     */
    public function process($file_path = '') {
        // 检查文件路径是否提供
        if (empty($file_path)) {
            $this->output->set_status_header(400);
            echo json_encode(['error' => 'File path is required.']);
            exit;
        }

        // 检查文件是否存在
        if (!file_exists($file_path)) {
            $this->output->set_status_header(404);
            echo json_encode(['error' => 'File not found.']);
            exit;
        }

        try {
            // 初始化CSVReader
            $this->csvreader->initialize(array(
                'filename' => $file_path,
                'delimiter' => ',',
                'enclosure' => '