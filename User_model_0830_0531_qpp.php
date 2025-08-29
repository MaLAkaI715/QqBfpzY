<?php
// 代码生成时间: 2025-08-30 05:31:12
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User Model
 * This model handles user data operations.
 */
class User_model extends CI_Model {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        // Load database library
        $this->load->database();
    }

    /**
     * Get User
     * Retrieves a user by their ID.
     *
     * @param int $id The user ID
     * @return array|null The user data or null if not found
     */
    public function get_user($id) {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    /**
     * Insert User
     * Inserts a new user into the database.
     *
     * @param array $data User data to insert
     * @return bool True on success, false on failure
     */
    public function insert_user($data) {
        if ($this->db->insert('users', $data)) {
            return true;
        } else {
            // Handle error - log or throw exception based on your error handling strategy
            log_message('error', 'Database insert failed');
            return false;
        }
    }

    /**
     * Update User
     * Updates a user's data in the database.
     *
     * @param int $id The user ID
     * @param array $data User data to update
     * @return bool True on success, false on failure
     */
    public function update_user($id, $data) {
        $this->db->where('id', $id);
        if ($this->db->update('users', $data)) {
            return true;
        } else {
            // Handle error - log or throw exception based on your error handling strategy
            log_message('error', 'Database update failed');
            return false;
        }
    }

    /**
     * Delete User
     * Deletes a user from the database.
     *
     * @param int $id The user ID
     * @return bool True on success, false on failure
     */
    public function delete_user($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('users')) {
            return true;
        } else {
            // Handle error - log or throw exception based on your error handling strategy
            log_message('error', 'Database delete failed');
            return false;
        }
    }

    // Additional methods can be added here for other user-related operations
}
