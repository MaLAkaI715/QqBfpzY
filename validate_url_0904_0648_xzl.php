<?php
// 代码生成时间: 2025-09-04 06:48:57
// validate_url.php
// 此文件用于验证URL链接的有效性

class ValidateUrl extends CI_Controller {

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
        // 加载URL辅助函数
        $this->load->helper('url');
    }

    /**
     * 验证URL链接
     *
     * @param string $url URL链接
     * @return bool 返回链接是否有效
     */
    public function index($url = '') {
        if (empty($url)) {
            // 如果URL为空，返回错误信息
            $this->output->set_status_header(400); // 400 Bad Request
            $this->output->set_output(json_encode(array(
                'status' => 'error',
                'message' => 'URL cannot be empty.'
            )));
            return false;
        }

        // 验证URL格式是否正确
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            // 如果URL格式不正确，返回错误信息
            $this->output->set_status_header(400); // 400 Bad Request
            $this->output->set_output(json_encode(array(
                'status' => 'error',
                'message' => 'Invalid URL format.'
            )));
            return false;
        }

        // 检查URL是否可以访问
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true); // 设置curl为HEAD请求
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // 检查HTTP状态码
        if ($response !== false && $httpcode >= 200 && $httpcode < 300) {
            // 如果URL有效，返回成功信息
            $this->output->set_status_header(200); // 200 OK
            $this->output->set_output(json_encode(array(
                'status' => 'success',
                'message' => 'URL is valid.'
            )));
            return true;
        } else {
            // 如果URL无效，返回错误信息
            $this->output->set_status_header(404); // 404 Not Found
            $this->output->set_output(json_encode(array(
                'status' => 'error',
                'message' => 'URL is not accessible.'
            )));
            return false;
        }
    }
}
