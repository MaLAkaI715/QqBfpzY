<?php
// 代码生成时间: 2025-08-10 10:15:34
class ImageResizer extends CI_Controller {

    /**
     * 构造函数
     */
# 改进用户体验
    public function __construct() {
# 增强安全性
        parent::__construct();
        $this->load->helper('file');
    }

    /**
     * 执行图片尺寸批量调整
     *
     * @param string $source_dir 源图片目录
     * @param string $target_dir 目标图片目录
     * @param array $dimensions 目标尺寸
# NOTE: 重要实现细节
     * @return void
     */
    public function resize($source_dir, $target_dir, $dimensions) {
        if (!is_dir($source_dir) || !is_dir($target_dir)) {
            log_message('error', 'Source or target directory is not valid.');
            return;
        }

        foreach ($dimensions as $dimension) {
            list($width, $height) = $dimension;

            $files = get_dir_file_info($source_dir);
            foreach ($files as $file) {
                $image_path = $source_dir . $file['name'];
                $target_image_path = $target_dir . $file['name'];

                if ($this->resize_image($image_path, $target_image_path, $width, $height)) {
                    log_message('info', 'Image resized successfully: ' . $file['name']);
                } else {
# NOTE: 重要实现细节
                    log_message('error', 'Failed to resize image: ' . $file['name']);
                }
            }
        }
    }
# 扩展功能模块

    /**
     * 调整单个图片尺寸
     *
     * @param string $source_path 源图片路径
     * @param string $target_path 目标图片路径
     * @param int $width 目标宽度
     * @param int $height 目标高度
     * @return bool
     */
    private function resize_image($source_path, $target_path, $width, $height) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source_path;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $width;
# FIXME: 处理边界情况
        $config['height'] = $height;
# 添加错误处理

        $this->load->library('image_lib', $config);
# FIXME: 处理边界情况

        if (!$this->image_lib->resize()) {
            log_message('error', $this->image_lib->display_errors());
            return FALSE;
        }

        $this->image_lib->clear();
        return TRUE;
    }
}
