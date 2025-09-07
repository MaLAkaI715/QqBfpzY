<?php
// 代码生成时间: 2025-09-07 15:10:42
class Backup_Restore {

    /**
     * Backup the database
     *
     * @param string $db_name Database name to backup
     * @param string $backup_dir Directory to save the backup file
     * @return array Returns an array with result status and file path
     */
    public function backupDatabase($db_name, $backup_dir) {
        $this->ci =& get_instance();
        $this->ci->load->db();
        $date = date('d-m-Y-H-i-s');
        $file_name = $db_name . '-' . $date . '.sql';
        $file_path = $backup_dir . '/' . $file_name;

        // Check if the backup directory exists
        if (!is_dir($backup_dir)) {
            mkdir($backup_dir, 0755, true);
        }

        // Start the backup process
        $this->ci->db->backup($file_path);

        // Return the result
        return array(
            'status' => $this->ci->db->db_backup_status,
            'file_path' => $file_path
        );
    }

    /**
     * Restore the database from a backup file
     *
     * @param string $file_path Path to the backup file
     * @return array Returns an array with result status
     */
    public function restoreDatabase($file_path) {
        $this->ci =& get_instance();
        $this->ci->load->db();

        // Start the restore process
        $this->ci->db->restore($file_path);

        // Return the result
        return array(
            'status' => $this->ci->db->db_restore_status
        );
    }
}
