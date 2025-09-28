<?php
// 代码生成时间: 2025-09-29 00:01:25
// File: file_split_merge.php
// Description: A CodeIgniter application to handle file split and merge operations.

defined('BASEPATH') OR exit('No direct script access allowed');

class FileSplitMerge extends CI_Controller {
    // Constructor
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('file');
    }

    // Function to split a file into smaller parts
    public function splitFile() {
        if ($this->input->post('split')) {
            $file_path = $this->input->post('file_path');
            $split_size = $this->input->post('split_size');
            
            if (!file_exists($file_path)) {
                $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 'error', 'message' => 'File not found']));
                return;
            }
            
            $file_name = basename($file_path);
            $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
            $split_file_dir = 'uploads/' . $file_name . '_split/';
            
            if (!is_dir($split_file_dir)) {
                mkdir($split_file_dir, 0777, true);
            }
            
            $file_size = filesize($file_path);
            $current_part = 0;
            while ($current_part < $file_size) {
                $split_file_path = $split_file_dir . $file_name . '_part_' . ($current_part + 1) . '.' . $file_extension;
                $split_part = fopen($file_path, 'rb');
                fseek($split_part, $current_part);
                $split_content = fread($split_part, $split_size);
                file_put_contents($split_file_path, $split_content);
                fclose($split_part);
                $current_part += $split_size;
            }
            $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 'success', 'message' => 'File successfully split']));
        }
    }

    // Function to merge split files into a single file
    public function mergeFiles() {
        if ($this->input->post('merge')) {
            $file_name = $this->input->post('file_name');
            $file_extension = $this->input->post('file_extension');
            $split_file_dir = 'uploads/' . $file_name . '_split/';
            
            if (!is_dir($split_file_dir)) {
                $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 'error', 'message' => 'Split files not found']));
                return;
            }
            
            $merged_file_path = 'uploads/' . $file_name . '.' . $file_extension;
            $merged_file = fopen($merged_file_path, 'wb');
            $files = scandir($split_file_dir);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $split_file_path = $split_file_dir . $file;
                    $split_file = fopen($split_file_path, 'rb');
                    while (!feof($split_file)) {
                        $content = fread($split_file, 1024);
                        fwrite($merged_file, $content);
                    }
                    fclose($split_file);
                    unlink($split_file_path);
                }
            }
            fclose($merged_file);
            rmdir($split_file_dir);
            $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 'success', 'message' => 'Files successfully merged']));
        }
    }
}
