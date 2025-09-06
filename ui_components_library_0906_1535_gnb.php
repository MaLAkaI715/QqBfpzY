<?php
// 代码生成时间: 2025-09-06 15:35:21
class Ui_components_library {

    /**
     * Reference to the CodeIgniter instance
     *
     * @var object
     */
    protected $CI;

    /**
     * Constructor
     *
     * Loads CodeIgniter super object and initializes the library
     *
     * @return void
     */
    public function __construct() {
        // Get the CI superobject
        $this->CI =& get_instance();
    }

    /**
     * Render a button component
     *
     * @param string $id The ID of the button
     * @param string $text The text of the button
     * @param string $type The type of the button (e.g., 'primary', 'secondary')
     * @return string The HTML code for the button
     */
    public function render_button($id, $text, $type = 'primary') {
        // Validate the type
        $types = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
        if (!in_array($type, $types)) {
            // Handle invalid type
            return 'Invalid button type';
        }

        // Build the button HTML
        $button = "<button type='button' id='" . htmlspecialchars($id) . "' class='btn btn-" . htmlspecialchars($type) . "'>" . htmlspecialchars($text) . "</button>";

        return $button;
    }

    /**
     * Render an input component
     *
     * @param string $type The type of the input (e.g., 'text', 'email')
     * @param string $name The name of the input
     * @param string $value The value of the input
     * @param array $attributes Additional attributes for the input
     * @return string The HTML code for the input
     */
    public function render_input($type, $name, $value = '', $attributes = []) {
        // Validate the type
        $types = ['text', 'email', 'password', 'number', 'date', 'time', 'checkbox', 'radio', 'file', 'hidden', 'submit', 'reset', 'image'];
        if (!in_array($type, $types)) {
            // Handle invalid type
            return 'Invalid input type';
        }

        // Build the input HTML
        $attributes_string = $this->build_attributes_string($attributes);
        $input = "<input type='" . htmlspecialchars($type) . "' name='" . htmlspecialchars($name) . "' value='" . htmlspecialchars($value) . "'" . $attributes_string . ">";

        return $input;
    }

    /**
     * Build a string of attributes from an associative array
     *
     * @param array $attributes The attributes array
     * @return string The attributes string
     */
    protected function build_attributes_string($attributes) {
        $attributes_string = '';
        foreach ($attributes as $key => $value) {
            $attributes_string .= " " . htmlspecialchars($key) . "='" . htmlspecialchars($value) . "'";
        }
        return $attributes_string;
    }
}
