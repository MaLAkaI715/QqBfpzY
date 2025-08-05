<?php
// 代码生成时间: 2025-08-05 12:41:54
class DatabasePoolManager {
    private $dbPool;
    private $config;
    private $poolSize;

    public function __construct($config, $poolSize = 5) {
        // Load the database configuration from CodeIgniter's database config file
        $this->config = $config;
        $this->poolSize = $poolSize;
        $this->dbPool = [];
        $this->initializePool();
    }

    /**
     * Initialize the database connection pool
     */
    private function initializePool() {
        for ($i = 0; $i < $this->poolSize; $i++) {
            $this->dbPool[] = $this->createDatabaseConnection();
        }
    }

    /**
     * Create a database connection
     * @return mysqli
     */
    private function createDatabaseConnection() {
        // Create a new database connection using CodeIgniter's database configuration
        $db = new mysqli($this->config['hostname'], $this->config['username'], $this->config['password'], $this->config['database']);

        // Check for connection errors
        if ($db->connect_error) {
            throw new Exception('Database connection failed: ' . $db->connect_error);
        }

        // Set the character set to UTF-8
        $db->set_charset('utf8');

        return $db;
    }

    /**
     * Get a database connection from the pool
     * @return mysqli
     */
    public function getDbConnection() {
        if (empty($this->dbPool)) {
            throw new Exception('Database connection pool is empty');
        }

        // Get the first available connection from the pool
        $db = array_shift($this->dbPool);

        // Push the connection back to the end of the pool
        array_push($this->dbPool, $db);

        return $db;
    }

    /**
     * Release a database connection back to the pool
     * @param mysqli $db
     */
    public function releaseDbConnection($db) {
        // Ensure the connection is still valid before releasing it
        if ($db->ping()) {
            array_push($this->dbPool, $db);
        } else {
            // Close the invalid connection and remove it from the pool
            $db->close();
        }
    }
}
