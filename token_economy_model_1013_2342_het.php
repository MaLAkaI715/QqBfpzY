<?php
// 代码生成时间: 2025-10-13 23:42:06
class TokenEconomyModel extends CI_Model {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        // Load the database library
        $this->load->database();
    }

    /**
     * Fetches token details from the database.
     *
     * @param int $tokenId The ID of the token to fetch.
     * @return array|null The token details or null if not found.
     */
    public function getTokenDetails($tokenId) {
        $query = $this->db->get_where('tokens', array('id' => $tokenId));
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return null;
    }

    /**
     * Creates a new token in the database.
     *
     * @param array $tokenData The data to insert into the token table.
     * @return bool The result of the insert operation.
     */
    public function createToken($tokenData) {
        if ($this->db->insert('tokens', $tokenData)) {
            return true;
        }
        return false;
    }

    /**
     * Updates an existing token in the database.
     *
     * @param int $tokenId The ID of the token to update.
     * @param array $tokenData The data to update in the token table.
     * @return bool The result of the update operation.
     */
    public function updateToken($tokenId, $tokenData) {
        $this->db->where('id', $tokenId);
        if ($this->db->update('tokens', $tokenData)) {
            return true;
        }
        return false;
    }

    /**
     * Deletes a token from the database.
     *
     * @param int $tokenId The ID of the token to delete.
     * @return bool The result of the delete operation.
     */
    public function deleteToken($tokenId) {
        if ($this->db->delete('tokens', array('id' => $tokenId))) {
            return true;
        }
        return false;
    }

    /**
     * Handles the token issuance logic.
     *
     * @param int $userId The ID of the user to issue the token to.
     * @param float $amount The amount of tokens to issue.
     * @return bool The result of the issuance operation.
     */
    public function issueToken($userId, $amount) {
        // Check if the user exists
        $user = $this->getUser($userId);
        if (!$user) {
            return false;
        }

        // Create a new token entry
        $tokenData = array(
            'user_id' => $userId,
            'amount' => $amount
        );

        return $this->createToken($tokenData);
    }

    /**
     * Retrieves a user by ID.
     *
     * @param int $userId The ID of the user to retrieve.
     * @return array|null The user details or null if not found.
     */
    private function getUser($userId) {
        $query = $this->db->get_where('users', array('id' => $userId));
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return null;
    }
}
