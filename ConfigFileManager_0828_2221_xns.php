<?php
// 代码生成时间: 2025-08-28 22:21:54
class ConfigFileManager {

    // Path to the configuration directory
    private $configPath;

    // Constructor
    public function __construct() {
        // Set the path to the configuration directory
        $this->configPath = APPPATH . 'config/';
    }

    /**
     * Load a configuration file
     *
     * @param string $configFile The name of the configuration file to load
     * @return mixed
     */
    public function load($configFile) {
        try {
            // Check if the file exists
            if (!file_exists($this->configPath . $configFile . '.php')) {
                throw new Exception('Configuration file not found.');
            }

            // Load the configuration file
            return include $this->configPath . $configFile . '.php';
        } catch (Exception $e) {
            // Handle errors
            log_message('error', $e->getMessage());
            return false;
        }
    }

    /**
     * Save a configuration file
     *
     * @param string $configFile The name of the configuration file to save
     * @param array $configData The data to be saved in the configuration file
     * @return bool
     */
    public function save($configFile, $configData) {
        try {
            // Check if the directory is writable
            if (!is_writable($this->configPath)) {
                throw new Exception('Configuration directory is not writable.');
            }

            // Convert the array to a PHP file
            $configContent = '<?php
' . var_export($configData, true) . ';';

            // Write to the configuration file
            return file_put_contents($this->configPath . $configFile . '.php', $configContent) !== false;
        } catch (Exception $e) {
            // Handle errors
            log_message('error', $e->getMessage());
            return false;
        }
    }
}
