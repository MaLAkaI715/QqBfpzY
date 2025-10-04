<?php
// 代码生成时间: 2025-10-05 03:04:22
// CpuUsageAnalyzer.php
/**
 * CPU使用率分析器
 *
 * 这个类提供了一个简单的方法来获取系统的CPU使用率。
 *
 * @package    CodeIgniter
 * @category   Utilities
 * @author     Your Name
 * @link       http://example.com
 */
class CpuUsageAnalyzer {

    /**
     * 获取CPU使用率
     *
     * 这个方法使用系统命令来获取CPU使用率。
     * 它假设系统上安装了`sar`命令。
     *
     * @return float|null 返回CPU使用率，如果无法获取则返回null。
     */
    public function getCpuUsage() {
        // 检查sar命令是否存在
        if (!$this->isSarAvailable()) {
            log_message('error', 'sar command is not available.');
            return null;
        }

        // 执行sar命令获取CPU使用率
        $output = $this->executeSarCommand();

        // 解析输出并提取CPU使用率
        $cpuUsage = $this->parseSarOutput($output);

        return $cpuUsage;
    }

    /**
     * 检查sar命令是否可用
     *
     * @return bool 返回sar命令是否可用。
     */
    private function isSarAvailable() {
        return is_executable('/usr/bin/sar');
    }

    /**
     * 执行sar命令获取CPU使用率
     *
     * @return string 命令输出。
     */
    private function executeSarCommand() {
        // 使用shell_exec执行sar命令并获取输出
        $output = shell_exec('sar -u 1 1');
        return $output;
    }

    /**
     * 解析sar命令输出
     *
     * @param string $output sar命令的输出。
     * @return float|null CPU使用率，如果无法解析则返回null。
     */
    private function parseSarOutput($output) {
        // 使用正则表达式匹配CPU使用率
        if (preg_match('/Average:.*?all.*?([0-9\.]+)/', $output, $matches)) {
            return floatval($matches[1]);
        } else {
            log_message('error', 'Unable to parse CPU usage from sar output.');
            return null;
        }
    }
}
