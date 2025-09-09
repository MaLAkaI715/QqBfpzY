<?php
// 代码生成时间: 2025-09-10 07:56:32
class ApiResponseFormatter {

    private $status;
    private $message;
    private $data;
    private $errors;

    /**
     * Constructor method to initialize the response formatter
     *
     * @param int $status   HTTP status code
     * @param string $message   Response message
     * @param array $data   Response data
     * @param array $errors   Error details
     */
    public function __construct($status = 200, $message = 'Success', $data = [], $errors = []) {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
        $this->errors = $errors;
    }

    /**
     * Set the HTTP status code
     *
     * @param int $status   HTTP status code
     */
    public function setStatus($status) {
        $this->status = $status;
    }

    /**
     * Get the HTTP status code
     *
     * @return int   HTTP status code
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Set the response message
     *
     * @param string $message   Response message
     */
    public function setMessage($message) {
        $this->message = $message;
    }

    /**
     * Get the response message
     *
     * @return string   Response message
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * Set the response data
     *
     * @param array $data   Response data
     */
    public function setData($data) {
        $this->data = $data;
    }

    /**
     * Get the response data
     *
     * @return array   Response data
     */
    public function getData() {
        return $this->data;
    }

    /**
     * Set the error details
     *
     * @param array $errors   Error details
     */
    public function setErrors($errors) {
        $this->errors = $errors;
    }

    /**
     * Get the error details
     *
     * @return array   Error details
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * Format the response for JSON output
     *
     * @return string   Formatted JSON response
     */
    public function formatResponse() {
        $response = [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
            'errors' => $this->errors
        ];

        // Remove 'errors' if empty to maintain consistency
        if (empty($this->errors)) {
            unset($response['errors']);
        }

        return json_encode($response);
    }
}
