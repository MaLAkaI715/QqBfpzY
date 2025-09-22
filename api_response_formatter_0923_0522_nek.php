<?php
// 代码生成时间: 2025-09-23 05:22:49
// api_response_formatter.php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiResponseFormatter {
    // 构造函数
    public function __construct() {
        // 加载CI框架的加载器
        $this->ci =& get_instance();
    }

    // 格式化成功响应
    public function success($data, $message = 'Operation successful') {
        $response = [
            'status' => true,
            'message' => $message,
            'data' => $data
        ];
        return $this->formatResponse($response);
    }

    // 格式化失败响应
    public function error($message = 'Operation failed', $data = null) {
        $response = [
            'status' => false,
            'message' => $message,
            'data' => $data
        ];
        return $this->formatResponse($response);
    }

    // 格式化响应数据
    private function formatResponse($response) {
        return json_encode($response);
    }
}

// 用法示例
$apiResponseFormatter = new ApiResponseFormatter();
echo $apiResponseFormatter->success(['user' => 'John Doe']); // 成功响应
echo $apiResponseFormatter->error('User not found'); // 失败响应
