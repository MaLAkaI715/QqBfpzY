<?php
// 代码生成时间: 2025-09-13 13:07:26
class ErrorLogCollector {

    /**
     * 错误日志文件路径
     *
     * @var string
     */
    private $logFilePath;

    /**
     * 构造函数
     *
     * 初始化错误日志文件路径
     *
     * @param string $logFilePath 错误日志文件路径
     */
    public function __construct($logFilePath) {
        $this->logFilePath = $logFilePath;
    }

    /**
     * 记录错误日志
     *
     * 将错误信息记录到日志文件中
     *
     * @param string $errorMessage 错误信息
     * @return bool 记录成功返回true，否则返回false
     */
    public function logError($errorMessage) {
        try {
            // 将错误信息格式化为字符串
            $errorStr = date('Y-m-d H:i:s') . ': ' . $errorMessage . PHP_EOL;

            // 打开日志文件
            $file = fopen($this->logFilePath, 'a');

            // 将错误信息写入文件
            if (false === fwrite($file, $errorStr)) {
                // 写入失败，返回false
                return false;
            }

            // 关闭文件
            fclose($file);

            // 返回true表示记录成功
            return true;
        } catch (Exception $e) {
            // 发生异常，记录失败，返回false
            return false;
        }
    }

    /**
     * 获取错误日志
     *
     * 读取错误日志文件内容
     *
     * @return string 错误日志内容
     */
    public function getErrorLog() {
        try {
            // 检查日志文件是否存在
            if (!file_exists($this->logFilePath)) {
                // 文件不存在，返回空字符串
                return '';
            }

            // 读取日志文件内容
            return file_get_contents($this->logFilePath);
        } catch (Exception $e) {
            // 发生异常，返回空字符串
            return '';
        }
    }
}
