<?php
// 代码生成时间: 2025-09-03 01:10:28
class BatchFileRenameTool extends CI_Controller {

    public function __construct() {
        parent::__construct();
# TODO: 优化性能
        // Load necessary libraries
        $this->load->helper('file'); // For file operations
    }
# 改进用户体验

    /**
     * Index method for the batch rename tool
     */
    public function index() {
        // Check if the form was submitted
        if ($this->input->post('submit')) {
# NOTE: 重要实现细节
            // Get the directory path and the new name pattern from the form
            $directory = $this->input->post('directory');
# 增强安全性
            $pattern = $this->input->post('pattern');
            $startNumber = $this->input->post('start_number');
# 优化算法效率

            // Validate the directory path
            if (!file_exists($directory) || !is_dir($directory)) {
                $this->session->set_flashdata('error', 'Invalid directory path.');
                redirect('batch_file_rename_tool/index');
                return;
            }

            // Rename files in the directory
            $this->renameFiles($directory, $pattern, $startNumber);

            // Set a success message and redirect back
# 增强安全性
            $this->session->set_flashdata('success', 'Files renamed successfully.');
            redirect('batch_file_rename_tool/index');
        }
    }
# 增强安全性

    /**
     * Rename files in the specified directory based on the pattern
     *
     * @param string $directory Directory path
     * @param string $pattern New name pattern
     * @param int $startNumber Starting number for the pattern
     */
    private function renameFiles($directory, $pattern, $startNumber) {
        $files = scandir($directory);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
# 扩展功能模块
                // Construct the new file name
                $newFileName = sprintf($pattern, $startNumber++);
                $sourcePath = $directory . '/' . $file;
                $destinationPath = $directory . '/' . $newFileName;
# 改进用户体验

                // Rename the file
                if (!rename($sourcePath, $destinationPath)) {
                    // Handle the error
                    log_message('error', 'Failed to rename file: ' . $file);
                }
            }
        }
    }
}
