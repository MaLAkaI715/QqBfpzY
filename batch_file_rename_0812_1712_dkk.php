<?php
// 代码生成时间: 2025-08-12 17:12:48
// 定义批量文件重命名类
class BatchFileRename {
    /**
     * 重命名文件的方法
     *
     * @param string $sourceDir 源目录路径
     * @param string $destDir 目标目录路径
     * @param string $prefix 新文件名前缀
     * @return bool|\CI_Session 返回重命名结果，或在有错误时返回会话对象
     */
    public function renameFiles($sourceDir, $destDir, $prefix) {
        // 检查目录是否存在
        if (!is_dir($sourceDir) || !is_dir($destDir)) {
            // 如果目录不存在，记录错误信息并返回错误
            log_message('error', 'The source or destination directory does not exist.');
            return false;
        }

        // 获取源目录下所有文件
        $files = scandir($sourceDir);

        // 遍历文件并重命名
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                // 获取文件扩展名
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                // 构造新文件名
                $newFileName = $prefix . '_' . time() . '.' . $ext;
                // 构造完整的源文件和目标文件路径
                $sourceFile = $sourceDir . '/' . $file;
                $destFile = $destDir . '/' . $newFileName;

                // 重命名文件
                if (rename($sourceFile, $destFile)) {
                    log_message('info', 'File ' . $file . ' renamed to ' . $newFileName . ' successfully.');
                } else {
                    log_message('error', 'Failed to rename file ' . $file . ' to ' . $newFileName . '.');
                    return false;
                }
            }
        }

        return true;
    }
}

// 使用示例
$sourceDir = "/path/to/source/directory";
$destDir = "/path/to/destination/directory";
$prefix = "new_prefix_";

// 初始化CI框架以使用日志功能
$CI = &get_instance();
$CI->load->library('session');

// 创建BatchFileRename对象
$renamer = new BatchFileRename();

// 执行文件重命名
$result = $renamer->renameFiles($sourceDir, $destDir, $prefix);

if ($result === true) {
    log_message('info', 'Batch file rename completed successfully.');
} else {
    log_message('error', 'Error occurred during batch file rename.');
    show_error('An error occurred during batch file rename.', 500, 'Batch Rename Error');
}
