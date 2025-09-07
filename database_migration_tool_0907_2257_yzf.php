<?php
// 代码生成时间: 2025-09-07 22:57:21
class DatabaseMigrationTool {

    protected $CI;
    protected $dbforge;
    protected $db;

    /**
     * Constructor
     */
    public function __construct() {
        // Get the CodeIgniter super-object
        $this->CI =& get_instance();

        // Load database forge and db libraries
        $this->CI->load->dbforge();
        $this->CI->load->database();

        $this->dbforge = $this->CI->dbforge;
# 增强安全性
        $this->db = $this->CI->db;
    }
# NOTE: 重要实现细节

    /**
     * Run database migration
     *
     * @param string $migration_file
     * @return bool
     */
    public function run_migration($migration_file) {
# 改进用户体验
        try {
            // Load the migration file
            include_once APPPATH . 'migrations/' . $migration_file . '.php';

            // Get the migration class name
            $migration_class = 'Migration_' . basename($migration_file, '.php');

            // Create an instance of the migration class
            $migration = new $migration_class();
# FIXME: 处理边界情况

            // Run the up() method
# 扩展功能模块
            if (method_exists($migration, 'up')) {
# FIXME: 处理边界情况
                $migration->up($this->dbforge);
            } else {
                throw new Exception('Migration class does not have an up() method.');
            }

            return true;
        } catch (Exception $e) {
            // Log the error
            log_message('error', $e->getMessage());
# TODO: 优化性能

            // Return false with error message
            return false;
        }
    }

    /**
# 改进用户体验
     * Rollback the last database migration
     *
     * @return bool
     */
    public function rollback_migration() {
        try {
            // Get the last migration version from database
            $query = $this->db->select('version')->order_by('version', 'DESC')->limit(1)->get('migrations');

            if ($query->num_rows() > 0) {
                $row = $query->row();
                $migration_file = 'migration_' . $row->version . '.php';

                // Load the migration file
# 改进用户体验
                include_once APPPATH . 'migrations/' . $migration_file;

                // Get the migration class name
                $migration_class = 'Migration_' . basename($migration_file, '.php');

                // Create an instance of the migration class
# 扩展功能模块
                $migration = new $migration_class();

                // Run the down() method
                if (method_exists($migration, 'down')) {
                    $migration->down($this->dbforge);
                } else {
                    throw new Exception('Migration class does not have a down() method.');
                }
            } else {
# 添加错误处理
                throw new Exception('No migrations found to rollback.');
            }

            return true;
        } catch (Exception $e) {
            // Log the error
            log_message('error', $e->getMessage());
# 增强安全性

            // Return false with error message
            return false;
        }
    }
}
