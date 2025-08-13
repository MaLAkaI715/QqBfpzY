<?php
// 代码生成时间: 2025-08-13 12:24:51
class Memory_usage_analyzer {

    /**
     * Constructor
     */
    public function __construct() {
        // Load necessary models, helpers or libraries
        // $this->load->model('memory_model');
    }

    /**
     * Get memory usage
     *
     * Returns the current memory usage of the application.
     *
     * @return float Memory usage in bytes
     */
    public function get_memory_usage() {
        if (function_exists('memory_get_usage')) {
            return memory_get_usage();
        } else {
            // Handle the error if the function is not available
            log_message('error', 'Memory usage function is not available.');
            return 0;
        }
    }

    /**
     * Get peak memory usage
     *
     * Returns the peak memory usage of the application.
     *
     * @return float Peak memory usage in bytes
     */
    public function get_peak_memory_usage() {
        if (function_exists('memory_get_peak_usage')) {
            return memory_get_peak_usage();
        } else {
            // Handle the error if the function is not available
            log_message('error', 'Peak memory usage function is not available.');
            return 0;
        }
    }

    /**
     * Format memory usage
     *
     * Formats the memory usage into a human-readable format.
     *
     * @param float $bytes Memory usage in bytes
     * @return string Formatted memory usage
     */
    private function format_memory_usage($bytes) {
        if ($bytes >= 1073741824) {
            $bytes = round($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = round($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = round($bytes / 1024, 2) . ' KB';
        } else {
            $bytes = $bytes . ' B';
        }

        return $bytes;
    }

    /**
     * Get formatted memory usage
     *
     * Returns the current memory usage in a human-readable format.
     *
     * @return string Formatted memory usage
     */
    public function get_formatted_memory_usage() {
        $bytes = $this->get_memory_usage();
        return $this->format_memory_usage($bytes);
    }

    /**
     * Get formatted peak memory usage
     *
     * Returns the peak memory usage in a human-readable format.
     *
     * @return string Formatted peak memory usage
     */
    public function get_formatted_peak_memory_usage() {
        $bytes = $this->get_peak_memory_usage();
        return $this->format_memory_usage($bytes);
    }

}
