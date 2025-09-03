<?php
// 代码生成时间: 2025-09-03 09:08:58
class DatabaseMigrationTool extends CI_Controller {

    /**
     * Constructor
     *
     * Loads the necessary database and migration libraries.
     */
    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load the database library
        $this->load->library('migration'); // Load the migration library
    }

    /**
     * Run migration
     *
     * Attempts to apply all pending migrations to the database.
     *
     * @return void
     */
    public function run_migration() {
        try {
            if ($this->migration->current()) {
                echo json_encode(array(
                    "status" => "success",
                    "message" => "Migration completed successfully."
                ));
            } else {
                echo json_encode(array(
                    "status" => "error",
                    "message" => "No migration to run or already up to date."
                ));
            }
        } catch (Exception $e) {
            // Handle migration errors
            echo json_encode(array(
                "status" => "error",
                "message" => "Migration failed: " . $e->getMessage()
            ));
        }
    }

    /**
     * Rollback migration
     *
     * Attempts to roll back the last batch of migrations.
     *
     * @return void
     */
    public function rollback_migration() {
        try {
            if ($this->migration->version(0)) {
                echo json_encode(array(
                    "status" => "success",
                    "message" => "Migration rolled back successfully."
                ));
            } else {
                echo json_encode(array(
                    "status" => "error",
                    "message" => "No migrations to rollback."
                ));
            }
        } catch (Exception $e) {
            // Handle rollback errors
            echo json_encode(array(
                "status" => "error",
                "message" => "Migration rollback failed: " . $e->getMessage()
            ));
        }
    }
}
