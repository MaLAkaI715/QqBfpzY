<?php
// 代码生成时间: 2025-09-18 04:19:59
class ConfigManager {

    /**
     * @var CI_Controller Reference to the CodeIgniter controller.
     */
    private $ci;

    /**
     * Constructor method
     *
     * @param CI_Controller $controller Reference to the CodeIgniter controller.
     */
    public function __construct(CI_Controller $controller) {
        $this->ci = $controller;
    }

    /**
     * Load configuration file
     *
     * @param string $filename Name of the configuration file.
     * @return mixed Returns the configuration array or false on failure.
     */
    public function loadConfig($filename) {
        // Check if file exists
        if (!file_exists(APPPATH . 'config/' . $filename . '.php')) {
            // Log error and return false
            log_message('error', 'Configuration file not found: ' . $filename);
            return false;
        }

        // Load the configuration file
        $config = $this->ci->config->load($filename, true);

        // Return the configuration array
        return $config ? $this->ci->config->item_all($filename) : false;
    }

    /**
     * Save configuration to file
     *
     * @param string $filename Name of the configuration file.
     * @param array $configData Array of configuration data to save.
     * @return bool Returns true on success, false on failure.
     */
    public function saveConfig($filename, $configData) {
        // Check if config data is an array
        if (!is_array($configData)) {
            // Log error and return false
            log_message('error', 'Invalid configuration data provided.');
            return false;
        }

        // Prepare the data to be written to the file
        $configContent = "<?php\
\
" . '/*
 * Auto-generated configuration file
 * DO NOT EDIT MANUALLY
 */
';
        foreach ($configData as $key => $value) {
            $configContent .= '\$config[\'' . addslashes($key) . '\'] = ' . var_export($value, true) . ";\
";
        }

        // Write the configuration to the file
        if (!file_put_contents(APPPATH . 'config/' . $filename . '.php', $configContent)) {
            // Log error and return false
            log_message('error', 'Failed to write configuration file: ' . $filename);
            return false;
        }

        // Return true on success
        return true;
    }
}
