<?php
// 代码生成时间: 2025-08-25 13:55:58
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Config Manager Class
 *
 * This class provides a simple interface to manage configuration files in CodeIgniter.
 *
 * @package CodeIgniter
 * @subpackage Libraries
 * @category Config Manager
 * @author Your Name
 * @link http://example.com
 */
class Config_manager {

    private $CI;
    private $config_path;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct() {
        // Get the CodeIgniter super-object
        $this->CI =& get_instance();
        // Set the configuration file path
        $this->config_path = APPPATH . 'config/';
    }

    /**
     * Load a configuration file
     *
     * @param string $file The name of the configuration file without the .php extension
     * @return bool
     */
    public function load($file) {
        $config_file = $this->config_path . $file . '.php';
        if (file_exists($config_file)) {
            include($config_file);
            return true;
        } else {
            log_message('error', 'Config file not found: ' . $config_file);
            return false;
        }
    }

    /**
     * Save a configuration array to a file
     *
     * @param string $file The name of the configuration file without the .php extension
     * @param array $config The configuration array to save
     * @return bool
     */
    public function save($file, $config) {
        $config_file = $this->config_path . $file . '.php';
        $config_string = '<?php' . 