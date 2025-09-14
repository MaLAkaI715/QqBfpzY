<?php
// 代码生成时间: 2025-09-15 01:06:22
class SystemPerformanceMonitor {

    /**
     * Get system memory usage
     *
     * @return float Memory usage in percentage
     */
    public function getMemoryUsage() {
        $memory_usage = function_exists('memory_get_usage') ? memory_get_usage() / 1024 / 1024 : 0;
        return $memory_usage;
    }

    /**
     * Get system CPU load
     *
     * @return float CPU load as a percentage
     */
    public function getCPULoad() {
        if (function_exists('sys_getloadavg')) {
            $load = sys_getloadavg();
            return max($load) * 100;
        }
        return 0;
    }

    /**
     * Get disk usage
     *
     * @param string $directory The directory to check disk usage for
     * @return float Disk usage in percentage
     */
    public function getDiskUsage($directory = '/') {
        $total = disk_total_space($directory);
        $used = disk_free_space($directory);
        return $total > 0 ? (1 - $used / $total) * 100 : 0;
    }

    /**
     * Get all system performance metrics
     *
     * @return array An array of system performance metrics
     */
    public function getAllMetrics() {
        $metrics = [
            'memory_usage' => $this->getMemoryUsage(),
            'cpu_load' => $this->getCPULoad(),
            'disk_usage' => $this->getDiskUsage()
        ];
        return $metrics;
    }
}

// Usage example
try {
    $monitor = new SystemPerformanceMonitor();
    $metrics = $monitor->getAllMetrics();
    echo json_encode($metrics);
} catch (Exception $e) {
    // Handle any exceptions that may occur
    echo json_encode(['error' => $e->getMessage()]);
}
