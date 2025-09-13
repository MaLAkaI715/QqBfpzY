<?php
// 代码生成时间: 2025-09-14 06:54:29
class AuditLogService extends CI_Controller {

    private $CI;

    public function __construct() {
        parent::__construct();
        // Get CodeIgniter instance
        $this->CI = &get_instance();
        // Load necessary libraries
        $this->CI->load->database();
    }

    /**
     * Logs an audit event into the database.
     *
     * @param string $userId    The ID of the user performing the action.
     * @param string $action    The action being performed.
     * @param string $description A detailed description of the action.
     * @param string $ipAddress The IP address of the user.
     * @return bool
     */
    public function log($userId, $action, $description, $ipAddress) {
        try {
            // Prepare the audit log data
            $logData = [
                'user_id' => $userId,
                'action' => $action,
                'description' => $description,
                'ip_address' => $ipAddress,
                'created_at' => date('Y-m-d H:i:s')
            ];

            // Insert the log data into the database
            if ($this->CI->db->insert('audit_logs', $logData)) {
                return true;
            } else {
                // Log an error if the insertion fails
                log_message('error', 'Failed to insert audit log data into the database.');
                return false;
            }
        } catch (Exception $e) {
            // Log the exception and return false
            log_message('error', 'Exception occurred while logging audit event: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Retrieves audit logs for a specific user.
     *
     * @param string $userId The ID of the user.
     * @return array
     */
    public function getLogsByUser($userId) {
        try {
            // Select logs for the specific user
            $query = $this->CI->db->get_where('audit_logs', ['user_id' => $userId]);
            return $query->result_array();
        } catch (Exception $e) {
            // Log the exception and return an empty array
            log_message('error', 'Exception occurred while retrieving audit logs: ' . $e->getMessage());
            return [];
        }
    }
}
