<?php
// 代码生成时间: 2025-08-24 11:27:21
class DataCleaner {

    protected $ci;

    /**
     * Constructor
     *
     * @return  void
     */
    public function __construct() {
        // Get the CodeIgniter super-object
        $this->ci =& get_instance();
    }

    /**
     * Trim and remove unnecessary spaces from a string
     *
     * @param   string  $data   The input string to clean
     * @return  string  The cleaned string
     */
    public function trimString($data) {
        return trim($data);
    }

    /**
     * Convert string to lowercase
     *
     * @param   string  $data   The input string to convert
     * @return  string  The converted string
     */
    public function toLowerCase($data) {
        return strtolower($data);
    }

    /**
     * Replace special characters with their HTML entities
     *
     * @param   string  $data   The input string to escape
     * @return  string  The escaped string
     */
    public function escapeSpecialChars($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Remove any HTML tags from a string
     *
     * @param   string  $data   The input string to strip tags from
     * @return  string  The string without HTML tags
     */
    public function stripHtmlTags($data) {
        return strip_tags($data);
    }

    /**
     * Sanitize input data using a predefined set of rules
     *
     * @param   array   $data   The input array to sanitize
     * @param   array   $rules  The sanitization rules
     * @return  array   The sanitized data
     */
    public function sanitizeInput($data, $rules) {
        foreach ($rules as $field => $rule) {
            if (isset($data[$field])) {
                switch ($rule) {
                    case 'trim':
                        $data[$field] = $this->trimString($data[$field]);
                        break;
                    case 'lowercase':
                        $data[$field] = $this->toLowerCase($data[$field]);
                        break;
                    case 'escape':
                        $data[$field] = $this->escapeSpecialChars($data[$field]);
                        break;
                    case 'strip_tags':
                        $data[$field] = $this->stripHtmlTags($data[$field]);
                        break;
                }
            }
        }
        return $data;
    }

    /**
     * Example usage of the DataCleaner class
     *
     * @return  void
     */
    public function exampleUsage() {
        $inputData = array(
            'name' => '  John Doe  ',
            'email' => '<EMAIL>@example.com</EMAIL>',
            'bio' => 'John is a <b>developer</b>.'
        );

        $sanitizationRules = array(
            'name' => 'trim',
            'email' => 'lowercase',
            'bio' => 'strip_tags'
        );

        $cleanedData = $this->sanitizeInput($inputData, $sanitizationRules);

        print_r($cleanedData);
    }
}

/*
 * Example of loading the DataCleaner class and using its methods
 */
$cleaner = new DataCleaner();
$cleaner->exampleUsage();
